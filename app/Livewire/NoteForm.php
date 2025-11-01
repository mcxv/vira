<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;


class NoteForm extends Component
{
    use WithFileUploads;

    public $noteId = null;
    public $title = '';
    public $content = '';
    public $status = false;
    public $userId = '';
    public $attachment = null;
    public $showModal = false;
    public $persianDate = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'boolean',
        'userId' => 'required|exists:users,id',
        'attachment' => 'nullable|file|max:10240',
        'persianDate' => 'nullable|string'
    ];

    protected $listeners = ['openEditModal'];

    public function openEditModal($noteId)
    {
        $this->noteId = $noteId;
        $this->loadNoteData();
        $this->showModal = true;
    }

    public function openModal()
    {
        $this->persianDate = Jalalian::now()->format('Y/m/d');
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function loadNoteData()
    {
        if ($this->noteId) {
            $note = Note::find($this->noteId);
            if ($note) {
                $this->title = $note->title;
                $this->content = $note->content;
                $this->status = $note->status;
                $this->userId = $note->user_id;
                if ($note->created_at) {
                    $this->persianDate = Jalalian::fromDateTime($note->created_at)->format('Y/m/d');
                } else {
                    $this->persianDate = Jalalian::now()->format('Y/m/d');
                }
            }
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'persian_date' => $this->persianDate,
            'content' => $this->content,
            'status' => $this->status,
            'user_id' => $this->userId
        ];

        if ($this->persianDate) {
            try {
                $jalaliDate = Jalalian::fromFormat('Y/m/d', $this->persianDate);
                $data['created_at'] = $jalaliDate->toCarbon();
            } catch (\Exception $e) {
                $data['created_at'] = now();
            }
        }

        if ($this->attachment) {
            if ($this->noteId) {
                $oldNote = Note::find($this->noteId);
                if ($oldNote && $oldNote->attachment) {
                    Storage::disk('public')->delete($oldNote->attachment);
                }
            }
            $filePath = $this->attachment->store('attachments', 'public');
            $fileSizeInMB = round($this->attachment->getSize() / (1024 * 1024), 2);

            $data['attachment'] = json_encode([
                'path' => $filePath,
                'size' => $fileSizeInMB
            ]);
        }


        if ($this->noteId) {
            Note::find($this->noteId)->update($data);
            $this->dispatch('noteUpdated');
            $this->dispatch('showMessage', message: 'یادداشت با موفقیت ویرایش شد.');
        } else {
            Note::create($data);
            $this->dispatch('noteAdded');
            $this->dispatch('showMessage', message: 'یادداشت با موفقیت ایجاد شد.');
        }

        $this->closeModal();
    }

    public function resetForm()
    {
        $this->reset(['noteId', 'title', 'content', 'status', 'userId', 'attachment']);
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.note-form', compact('users'));
    }
}
