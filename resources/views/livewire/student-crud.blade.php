<div>
    @include('livewire.includes.create-student-box')
    <h2 class="py-4 mb-2 text-4xl underline font-semibold text-center text-gray-900">Student List</h2>
    <div id="student-list">
        @foreach($students as $student)
            @include('livewire.includes.student-card')
        @endforeach

        <div class="my-2">
            {{ $students->links() }}
        </div>
    </div>
</div>