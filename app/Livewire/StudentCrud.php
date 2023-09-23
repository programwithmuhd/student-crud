<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class StudentCrud extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    #[Rule('required|min:1|max:1')]
    public $grade;

    #[Rule('required|min:3|max:50')]
    public $department;

    public $editingStudentId;

    #[Rule('required|min:3|max:50')]
    public $editingStudentName;

    public function create() {
        $validated = $this->validate();

        Student::create($validated);

        $this->reset('name', 'grade', 'department');

        session()->flash('success', 'Student added!');

        $this->resetPage();
    }

    public function edit($studentId) {
        $this->editingStudentId = $studentId;
        $this->editingStudentName = Student::find($studentId)->name;
    }

    public function cancelEdit() {
        $this->reset('editingStudentId', 'editingStudentName');
    }

    public function update() {
        Student::find($this->editingStudentId)->update([
            'name' => $this->editingStudentName
        ]);

        $this->cancelEdit();
    }

    public function delete($studentId)
    {
        Student::find($studentId)->delete();
    }

    public function render()
    {
        return view('livewire.student-crud', [
            'students' => Student::latest()->paginate(5)
        ]);
    }
}