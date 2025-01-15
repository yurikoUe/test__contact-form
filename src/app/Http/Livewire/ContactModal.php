<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Category;


class ContactModal extends Component
{
    public $contact;
    public $showModal = false; // 最初は非表示


    public function mount($contact = null)
    {
        $this->contact = $contact;
    }

    // モーダルを開くメソッド
    public function openModal($contactId)
    {
        $this->contact = Contact::find($contactId);

         // レコードが見つからない場合の処理
        if (!$this->contact) {
            session()->flash('error', 'Contact not found');
            return;
        }

        $this->showModal = true;
    }

    // モーダルを閉じるメソッド
    public function closeModal()
    {
        $this->showModal = false;
    }

    // 削除処理
    public function deleteContact($contactId)
    {
            $contact = Contact::find($contactId);

             // バリデーションを追加
            if (!$contact) {
                session()->flash('error', 'Contact not found.');
                return;
            }
            
            if ($contact) {
                $contact->delete();
                $this->closeModal();
            }
            return redirect()->route('admin');
    }

    public function render()
    {
        return view('livewire.contact-modal');
    }

}