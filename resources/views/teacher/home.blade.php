@extends('layouts.app')

@section('content')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<!-- DataTables CSS and JS -->
<link href="{{ asset('css/datatable.min.css') }}" rel="stylesheet">


<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/datatable.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<style>
.circle-icon {
    display: inline-block;
    width: 30px; /* Width of the circle */
    height: 30px; /* Height of the circle */
    background-color: blue; /* Circle color */
    color: white; /* Text color */
    border-radius: 50%; /* Makes it a circle */
    margin-right: 10px; /* Space between the circle and name */
    text-align: center; /* Center the text */
    line-height: 30px; /* Center text vertically */
    font-weight: bold; /* Make the text bold */
}
</style>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light  mb-4" style="float: right;">
        <!-- <a class="navbar-brand" href="/teacher/home">Teacher Portal</a> -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <h2 style="color:red">tailwebs.</h2>

    <!-- Student List Table -->
    <table id="studentTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>
                    <span class="circle-icon">{{ strtoupper(substr($student->name, 0, 1)) }}</span>
                    <span class="student-name">{{ $student->name }}</span>
                </td>
                <td>{{ $student->subject }}</td>
                <td>{{ $student->marks }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <!-- <i class="fa fa-caret-down"></i> -->
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-btn" data-id="{{ $student->id }}" href="#" data-toggle="modal" data-target="#editStudentModal">Edit</a>
                            <a class="dropdown-item delete-btn" data-id="{{ $student->id }}" href="#">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Add New Student Button and Modal -->
    <button class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal" style="background-color:gray;width:20%">Add</button>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addStudentLabel">Add</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        @csrf
                        <div class="form-group">
                        <label for="name">Student Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span> <!-- Icon for Student Name -->
                            </div>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span> <!-- Icon for Subject -->
                            </div>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="marks">Marks</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-brands fa-font-awesome"></i></span> <!-- Icon for Marks -->
                            </div>
                            <input type="number" class="form-control" id="marks" name="marks" required>
                        </div>
                    </div>
                    <div class="text-center"> <!-- Centering the button -->
                        <button type="submit" class="btn btn-dark btn-lg" style="width:166px">Add</button> <!-- Larger button -->
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editStudentLabel">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm">
                        @csrf
                        <input type="hidden" id="editStudentId" name="id">
                        <label for="editName">Name</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span> <!-- Icon for Subject -->
                                </div>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editSubject">Subject</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-book"></i></span> <!-- Icon for Subject -->
                                </div>
                                <input type="text" class="form-control" id="editSubject" name="subject" required>
                            </div>
                        </div>
                        <div class="form-group">

                        <label for="editMarks">Marks</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-brands fa-font-awesome"></i></span> <!-- Icon for Subject -->
                                </div>
                                <input type="number" class="form-control" id="editMarks" name="marks" required>
                            </div>
                        </div>
                        <div class="text-center"> <!-- Centering the button -->
                        <button type="submit" class="btn btn-dark" style="width:166px">Update</button> <!-- Larger button -->
                         </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#studentTable').DataTable({
            "processing": true,
            "serverSide": false, // Set to true if you plan to use server-side processing
            "paging": true,     // Enable pagination
            "searching": true,  // Enable search/filter functionality
            "ordering": true,   // Enable column-based sorting
            "info": true,       // Enable table information display
           "pageLength": 5,
           "lengthChange": false
        });
    });
</script>
<script>
    // const updateUrl = "{{ route('student.update', ':id') }}"; // This is the base URL with a placeholder
    // Delete student functionality
    document.querySelectorAll('.delete-btn').forEach(button => {
        const updateUrl = "{{ route('student.delete', ':id') }}";
         // Use the update URL with the specific ID

        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let url = updateUrl.replace(':id', id);
            if (confirm('Are you sure you want to delete this student?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.success);
                    location.reload(); // Reload page after deletion
                });
            }
        });
    });

    // Open edit student modal and populate fields
    document.querySelectorAll('.edit-btn').forEach(button => {
        const updateUrl = "{{ route('student.show', ':id') }}";
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let url = updateUrl.replace(':id', id);
            // Fetch existing student data
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Populate fields in the edit modal
                document.getElementById('editStudentId').value = data.id;
                document.getElementById('editName').value = data.name;
                document.getElementById('editSubject').value = data.subject;
                document.getElementById('editMarks').value = data.marks;
            });
        });
    });

    // Edit student form submission
    document.getElementById('editStudentForm').addEventListener('submit', function(e) {
        const updateUrl = "{{ route('student.update', ':id') }}";
        e.preventDefault();
        let formData = new FormData(this);
        let id = document.getElementById('editStudentId').value;
        let url = updateUrl.replace(':id', id); // Use the update URL with the specific ID

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.success);
            location.reload(); // Reload page after updating student
        });
    });

    // Add new student form submission (existing code)
    document.getElementById('addStudentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const addStudentUrl = "{{ route('student.add') }}"; // Assuming you have named your route 'student.add'

        let formData = new FormData(this);

        fetch(addStudentUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.success);
            location.reload(); // Reload page after adding student
        });
    });
</script>
@endsection
