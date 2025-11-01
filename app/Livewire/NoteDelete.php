<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Storage;

class NoteDelete extends Component
{
    public $noteId;
    public $confirmingDeletion = false;

    protected $listeners = ['openDeleteModal' => 'openModal'];
    
    public function openModal($noteId)
    {
        $this->noteId = $noteId['noteId'] ?? $noteId;
        $this->confirmingDeletion = true;
    }
    
    public function closeModal()
    {
        $this->confirmingDeletion = false;
        $this->noteId = null;
    }
    
    public function delete()
    {
        $note = Note::findOrFail($this->noteId);
        
        if ($note->attachment) {
            Storage::disk('public')->delete($note->attachment);
        }
        
        $note->delete();
        
        $this->dispatch('noteDeleted');
        $this->closeModal();
          $this->dispatch('showMessage', message: 'یادداشت با موفقیت حذف شد.');
    }
    
    public function render()
    {
        return view('livewire.note-delete');
    }
}