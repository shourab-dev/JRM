<x-backend-layout>
    @push('customCss')
    <style>
        .studentDataFormSubmitBtn {
            display: none;
        }

        .studentList .studentCard {
            width: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            padding: 20px 10px;
            margin: 15px 0;
        }

        .studentList h2 {
            width: 40%;
            font-size: 16px;
            font-weight: 700;
        }

        .studentData {
            border-radius: 15px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            background-color: white;
            max-height: 700px;
            padding: 15px 30px;
            overflow-y: auto;
        }

        .studentData .form-switch .form-check-input {
            width: 50px;
        }

        .studentData .form-switch .form-check-input:checked:before {
            margin-left: 24px;
        }

        .btn-success-soft {
            color: rgb(15, 154, 57);
        }

        .btn-success-soft:hover {
            color: rgb(15, 154, 57);
            background-color: rgb(238, 255, 240);
        }

        .btn-danger-soft:hover {
            background-color: rgb(255, 225, 225);
        }

        .btn-danger-soft,
        .btn-success-soft {
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 8px 0px;
        }
    </style>
    @endpush
    @if (session()->has('success'))

    <x-slot name="msg">
        {{ session('success') }}
    </x-slot>
    @endif

    <h2 class="fs-lg fw-medium mb-4">
        {{ $batch->name }} Batch
    </h2>
    <hr>

    <div class="grid columns-2 gap-3 mt-5">
        <div class="grid-col-6 studentList" style="align-self: start;">
            @foreach ($studentsDetails as $key=>$student)

            <div class="studentCard d-flex justify-content-around align-items-center">
                <h2>{{ ++$key }}. &nbsp; {{ $student['name'] }}</h2>
                <p class="leftout text-center fw-bold">
                    <span class="text-danger">Un-paid</span> <br>
                    {{ $student['unPaid'] }} tk
                </p>
                <p class="paid text-center fw-bold ">
                    <span class="text-success">Paid</span> <br>
                    {{ $student['total'] - $student['unPaid'] }} tk
                </p>
                <p class="total text-center fw-bold">
                    <span>Total</span> <br>
                    {{ $student['total'] }} tk
                </p>
                <span class="viewReport">
                    <a href="#" data-id="{{ $student['id'] }}" class="btn btn-sm btn-primary viewStudentReport"><i
                            data-feather="folder"></i></a>
                </span>

            </div>

            @endforeach
        </div>
        <div class="grid-col-6 studentData">
            <form action="" method="POST" id="studentDataForm">
                @csrf
                @method('put')
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="fw-bold fs-lg  studentName">Us Name</h3>
                    <button class="btn  btn-sm btn-primary studentDataFormSubmitBtn" type="submit"
                        id="studentDataFormSubmitBtn">
                        <i data-feather="user-check"></i>
                    </button>
                </div>
                <hr>
                <table class="table table-responsive" id="studentFineTableData">
                    <tr class="tableHeading">
                        <th class="fw-bold">Date</th>
                        <th class="fw-bold">Amount</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Action</th>

                    </tr>


                </table>
            </form>
        </div>
    </div>





    @push('customJs')


    <script>
        //* AJAX REQUEST HERE

        let reportBtn = $('.viewStudentReport')
        let studentName = $('.studentName')
        let studentDataForm = $('#studentDataForm')
        let studentFineTableData = $('#studentFineTableData')
        let studentDataFormSubmitBtn = $('#studentDataFormSubmitBtn')

        reportBtn.on('click', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id')
            let placeholderUrl = "{{ route('student.get.fine', ':id') }}"
            let url = placeholderUrl.replace(':id', id)
            
            //* SENDING REQUEST  
            $.ajax({
            url: url,
            dataType: 'json',
            type: 'get',
            success: function(res){
                studentName.html(res.name);
                let fines = res.fines
                let rows = []
                if(fines.length > 0){
                fines.map(fine => {
                    let row = `<tr class="tableContent">
                        <td class="fw-bold fs-md">
                           ${ new Date(fine.created_at).toLocaleDateString("en-US",{  year: 'numeric', month: 'long',weekday: 'long', day: 'numeric' }) }
                            </td>
                        <td class="fw-bold">
                            <span class="fs-lg">${fine.amount ? fine.amount : 0} tk</span>
                        </td>
                        <td>
                            <span class="btn btn-rounded btn-${fine.is_paid == 1 ? 'success' : 'danger'}-soft w-20  ">${fine.is_paid == 1 ? 'paid' : 'unpaid'}</span>
                        </td>
                        <td>
                            <div class="form-check form-switch paidStatusBtn">
                                <input class="form-check-input" ${fine.is_paid == 1 ? 'checked' : ''} type="checkbox" value="${fine.id},{{ true }}" name="updateValue[]">
                            </div>
                            <input type="hidden" class="hiddenFineId" name="fineId[]" value="${fine.id}">
                        </td>
                    </tr>`
                rows.push(row)
                studentDataFormSubmitBtn.show()
                let formUrl = "{{ route('student.update.fine', ':id') }}";
                formUrl = formUrl.replace(':id', res.id)
                studentDataForm.attr('action', formUrl)



                })
                } else{
                    let row = `<tr class="tableContent">
                        <td colspan="4" class="text-center fw-bold">No Data Found 😃 !!</td>
                    </tr>`;
                    rows.push(row)
                    studentDataFormSubmitBtn.hide()
                }

                studentFineTableData.find("tr.tableContent").contents().remove();
                studentFineTableData.append(rows)


            }

            })


        })

        



    </script>

    @endpush

</x-backend-layout>