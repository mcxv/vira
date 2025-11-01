<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Note;

class NotesManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $userFilter = '';
    public $message = '';

    protected $listeners = [
        'noteAdded' => 'handleNoteAdded',
        'noteDeleted' => 'handleNoteDeleted',
        'noteUpdated' => 'handleNoteUpdated',
        'showMessage' => 'showMessage'
    ];

    public function handleNoteAdded()
    {
        $this->resetPage();
        $this->showMessage('یادداشت جدید ایجاد شد.');
    }

    public function handleNoteDeleted()
    {
        $this->resetPage();
        $this->showMessage('یادداشت حذف شد.');
    }

    public function handleNoteUpdated()
    {

        $this->showMessage('یادداشت ویرایش شد.');
    }

    public function setStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function toggleNoteStatus($noteId)
    {
        $note = Note::find($noteId);

        if ($note) {
            $note->update([
                'status' => !$note->status
            ]);

            $this->showMessage($note->status ?
                'یادداشت به وضعیت انجام شده تغییر کرد.' :
                'یادداشت به وضعیت انجام نشده تغییر کرد.');
        }
    }

    public function showMessage($message)
    {
        $this->message = $message;

        $this->dispatch('resetMessage');
    }

    public function render()
    {
        // $users = User::all();
        // $query = Note::get();
        // foreach($query as $q){
        //     $q->delete();
        // }
        // foreach($users as $u){
        //     $u->delete();
        // }

        $users = User::all();
        $query = Note::with('user');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->userFilter) {
            $query->where('user_id', $this->userFilter);
        }

        $notes = $query->orderBy('created_at', 'desc')->paginate(21);

        return view('livewire.notes-manager', compact('users', 'notes'));
    }
}
