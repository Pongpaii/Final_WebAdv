@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <h3> ::student Managements ::
        <a href="/student/adding" class="btn btn-primary btn-sm"> Add student </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info">
                <th width="5%" class="text-center">No.</th>
                <th width="5%">image</th>
                <th width="65%">student Name & Detail </th>
               
                <th width="5%" class="text-center">edit</th>
                <th width="5%" class="text-center">delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $row)
            <tr>
                <td align="center">{{ $row->id }}</td>
                <td>
                    
                    <img src="{{ asset('storage/' . $row->student_img) }}" width="100"></td>
                <td>
                    <b>Name: {{ $row->student_name }}</b> <br>
                    <b>Student Code: {{ $row->student_code }}</b> <br>
                    <b>Phone: {{ $row->student_phone }}</b> <br>
                   
                </td>
               
                <td align="center">
                    <a href="/student/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
                </td>
                <td align="center">

                    {{-- <form action="/student/remove/{{$row->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sure to Delete !!');">delete</button>
                    </form> --}}

                    
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">delete</button>

                        <form id="delete-form-{{ $row->id }}" action="/student/remove/{{$row->id}}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $students->links() }}
    </div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้ากด "ลบเลย" ให้ submit form ที่ซ่อนไว้
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

