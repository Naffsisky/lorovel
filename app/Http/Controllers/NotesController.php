<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotesController extends Controller
{
    public function getIndexData() {
        $notesData = $this->getNotes();

        return view('notes', compact('notesData'));
    }

    public function getNotes(){
        $urlNotes = "http://35.219.123.247/app2";
        $serverResponse = Http::get($urlNotes);

        if ($serverResponse->successful()) {
            $notesData = $serverResponse->json()['data']['notes'];
            
            return $notesData;
        } else {
            return "Failed to fetch data from API";
        }
    }

    public function createNoteForm() {
        return view('create_note');
    }

    public function createNote(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'required|string',
        ]);

        $newNote = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'tags' => $request->input('tags'),
        ];

        $urlCreateNote = "http://35.219.123.247/app2";
        $serverResponse = Http::post($urlCreateNote, $newNote);

        if ($serverResponse->successful()) {
            return redirect()->route('notes')->with('success', 'Note created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create note. Please try again.');
        }
    }

    public function editNote($id) {
        $note = $this->getNoteById($id);
    
        return view('edit_note', compact('note'));
    }
    
    public function updateNote(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'required|string',
        ]);
    
        $updatedNote = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'tags' => $request->input('tags'),
        ];
    
        $urlUpdateNote = "http://35.219.123.247/app2/{$id}";
        $serverResponse = Http::put($urlUpdateNote, $updatedNote);
    
        if ($serverResponse->successful()) {
            return redirect()->route('notes')->with('success', 'Note updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update note. Please try again.');
        }
    }
    
    private function getNoteById($id) {
        $urlNoteById = "http://35.219.123.247/app2/{$id}";
        $serverResponse = Http::get($urlNoteById);
    
        if ($serverResponse->successful()) {
            $note = $serverResponse->json()['data']['note'];
            return $note;
        } else {
            abort(404);
        }
    }

    public function deleteNote($id) {
        $urlDeleteNote = "http://35.219.123.247/app2/{$id}";
        $serverResponse = Http::delete($urlDeleteNote);
    
        if ($serverResponse->successful()) {
            return redirect()->route('notes')->with('success', 'Note deleted successfully!');
        } else {
            dd($serverResponse->json());
            return redirect()->back()->with('error', 'Failed to delete note. Please try again.');
        }
    }
}
