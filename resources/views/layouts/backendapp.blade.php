<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Rubick admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Dashboard - JRM System</title>
    <!-- BEGIN: CSS Assets-->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('backend/css/nice-select2.css') }}">
    @vite(['resources/backend/css/app.css','resources/backend/css/style.css'])
    @stack('customCss')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="main">
    <div id="fineModal" class="fineModal--collapse">
        <div class="container">
            <div class="modalContainer">
                <div class="modalHeader d-flex justify-content-between align-items-center pb-2 border-bottom">
                    <h2 class="fw-bold fs-xl">Add Jorimana</h2>
                    <button class="btn btn-danger btn-sm closeModalBtn">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modalBody  mt-5">

                    <div class="selectBatches">
                        <label class="w-full">
                            <span>Batch Selection</span>
                            <select name="batch" class="form-control">
                                <option disabled selected>Select A Batch</option>
                            </select>
                        </label>
                    </div>

                    <div class="allStudentsLists ">

                        <div class="studentList">
                            <div class="col">
                                <h2 class="fw-bold fs-md">Student Name</h2>
                                <select name="studentids[]" class="studentids form-control niceSelect wide"
                                    multiple="multiple">

                                </select>
                            </div>
                            <div class="col">
                                <h2 class="fw-bold fs-md">Amount</h2>
                                <input type="number" id="amount" name="amount" class="form-control">

                            </div>
                            <div class="col">
                                <h2 class="fw-bold fs-md">Status</h2>
                                <select name="is_paid" id="is_paid" class="form-control niceSelect">
                                    <option value="{{ false }}">Un-Paid</option>
                                    <option value="{{ true }}">Paid</option>
                                </select>
                            </div>
                            <div>
                                <br>
                                <span class="btn btn-primary submitFineButton"><i data-feather="user-check"></i></span>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
        <div class="toast-container show position-fixed end-0 p-3" style="bottom: 16px">
            <div id="liveToastFine" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">

                    <strong class="me-auto">{{ env('APP_NAME') }}</strong>
                    <small>1 sec ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="intro-x d-flex align-items-center ps-5 pt-4">
                <span class="d-none d-xl-block text-white fs-lg ms-3"> <span class="fw-medium">JRM System</span> </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="side-menu {{ request()->routeis('dashboard') ? 'side-menu--active side-menu--open' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title">
                            Dashboard

                        </div>
                    </a>

                </li>
                <li>
                    <a href="javascript:;"
                        class="side-menu {{ request()->routeis(['batch*', 'fine*','student*']) ? 'side-menu--active side-menu--open' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title">
                            Manage Students
                            <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeis(['batch*', 'fine*','student*']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="{{ route('batch.add') }} " class="side-menu ">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Manage Batch </div>
                            </a>
                        </li>


                    </ul>
                </li>

            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb me-auto d-none d-sm-flex"> <a
                        href="{{ route('dashboard') }}">Application</a> <i data-feather="chevron-right"
                        class="breadcrumb__icon"></i> <a href="index.html" class="breadcrumb--active">Dashboard</a>
                </div>
                <!-- END: Breadcrumb -->

                {{-- * ADD JORIMANA BUTTON --}}
                <button class="btn btn-primary mx-5 intro-x" id="addFineBtn">
                    Add Jorimana +
                </button>
                {{-- * ADD JORIMANA BUTTON ENDS --}}

                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-pill overflow-hidden shadow-lg image-fit zoom-in"
                        role="button" aria-expanded="false" data-bs-toggle="dropdown">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />

                        @else
                        <span class="inline-flex rounded-md">

                            {{ Auth::user()->name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </span>
                        @endif
                    </div>
                    <div class="dropdown-menu w-56">
                        <ul class="dropdown-content bg-theme-26 dark-bg-dark-6 text-white">
                            <li class="p-2">
                                <div class="fw-medium text-white">{{ str()->headline(Auth::user()->name) }}</div>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                            </li>
                            <li>
                                <a href="{{ route('profile.show') }}"
                                    class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i
                                        data-feather="user" class="w-4 h-4 me-2"></i> Profile </a>
                            </li>

                            <li>
                                <a href="index.html"
                                    class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i
                                        data-feather="lock" class="w-4 h-4 me-2"></i> Reset Password </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                            </li>
                            <li>
                                <a href="#" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"
                                    onclick="event.preventDefault();document.querySelector('#logout').submit()">
                                    <i data-feather="toggle-right" class="w-4 h-4 me-2"></i> Logout
                                </a>
                                <form method="POST" id="logout" action="{{ route('logout') }}" x-data>
                                    @csrf


                                </form>



                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            <div class="grid columns-12 gap-6">
                <div class="g-col-12   py-3">
                    @if (isset($msg))
                    <div class="toast show " role="alert" aria-live="assertive" aria-atomic="true"
                        style="right: 50px; position: absolute;bottom:90px;z-index:99">
                        <div class="toast-header" style="background: rgb(4, 71, 255); color: white;">
                            <strong class="me-auto">{{ env('APP_NAME') }}</strong>
                            <button type="button" style="background: transparent" data-bs-dismiss="toast"
                                aria-label="Close">
                                <i data-feather="x-circle"></i>
                            </button>
                        </div>
                        <div class="toast-body" style="font-size: 16px;">
                            <i data-feather="thumbs-up" class="mb-2 w-4 h-4"></i>
                            {{ $msg}}
                        </div>
                    </div>
                    @endif


                    {{ $slot }}


                </div>

            </div>
        </div>
        <!-- END: Content -->
    </div>

    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('backend/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/nice-select2.js') }}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @vite('resources/backend/js/app.js')

    <script>
        let niceSelects = document.querySelectorAll(".niceSelect")
        niceSelects = Array.from(niceSelects)
        let niceSelectInstances = []
         niceSelects.map(niceSelect => {
             let niceSelectIns =  NiceSelect.bind(niceSelect, {searchable: true});
            niceSelectInstances.push(niceSelectIns)
        })
        //* ADD FINES 
        let batchSelect = $('select[name="batch"]')
        let modal = $('#fineModal')
        let addFineBtn = $('#addFineBtn')
        let closeModalBtn = $('.closeModalBtn')
        let count = 0
        addFineBtn.on('click', openModal)
        closeModalBtn.on('click', closeModal)
       function openModal(){
        modal.addClass('activeModal')
       }
       function closeModal(){
        modal.removeClass('activeModal')
       }

       
       //* RETURN ALL BATCHES ON HOVER
       $('.selectBatches').on('mouseenter',function(){
            let options = []
            if(count == 0){
            $.ajax({
                url: "{{ route('batch.all') }}",
                dataType: 'json',
                type: 'get',
                success: function(res){
                    
                   res.map(batch => {
                       let option = `<option class="dynamicBatches" value="${batch.id}">${batch.name}</option>`
                       options.push(option)
                   }) 
                   batchSelect.find("option.dynamicBatches").remove();
                   batchSelect.append(options)
                   count = count +1

                }
            })
            }
            return false;

       })

       //* RETURN ALL STUDENTS ON A BATCH
       let studentIds = $('.studentids');
       $('.selectBatches').on('change', function(){
            let batchId = batchSelect.val();
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            url: "{{ route('batch.all.student') }}",
            dataType: 'json',
            type: 'post',
            data: {id: batchId},
            success: function(res){
                let options = []
                res.map(student => {
                    let option = `<option value="${student.id}">${student.name}</option>`
                    options.push(option)
                })
                studentIds.html(options)
                niceSelectInstances[0].update();
                
            }
            })
       })


       //*SAVE FINES
     const toastLiveExample = document.getElementById('liveToastFine')
        
    const toast = new bootstrap.Toast(toastLiveExample)
        
      

       $('.submitFineButton').on('click',function(){
            let studentValues = studentIds.val()
            let amount = $('input#amount').val()
            let is_paid = $('select#is_paid').val()
            if(studentValues.length > 0){

                $.ajax({
                    headers:{
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('fine.store') }}",
                    data: {ids: studentValues, amount:amount, is_paid: is_paid},
                    dataType: 'text',
                    type: 'post',
                    success: function(res){
                        console.log(res)
                       
                        $('input#amount').val('')
                       $('select#is_paid').val('')
                        studentIds.children('option').removeAttr("selected")
                       niceSelectInstances[0].update()
                       niceSelectInstances[1].update()
                       $('#liveToastFine').children('div.toast-body').html(res)
                       toast.show()
                    }
                })


            }
            return false;

       })


    </script>
    @stack('customJs')
    <!-- END: JS Assets-->
</body>

</html>