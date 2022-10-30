<x-backend-layout>
    @if (session()->has('success'))

    <x-slot name="msg">
        {{ session('success') }}
    </x-slot>
    @endif

    <div class="g-col-12">
        <h2 class="fs-lg fw-medium ">
            Manage Batches
        </h2>

        <div class="grid columns-12">
            <div class="g-col-8">
                <table class="table table-responsive">
                    <tr>
                        <th>#</th>
                        <th>Batch Name</th>
                        <th>Total Students</th>
                        <th>View</th>
                        <th>Created At</th>
                    </tr>
                    @forelse ($batches as $key=>$batch)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $batch->name }}</td>
                        <td>{{ $batch->students_count }}</td>
                        <td>
                            <a href="{{ route('batch.view', $batch->slug) }}" class="btn btn-warning btn-sm">
                                <i style="width: 16px;" data-feather="plus"></i>
                            </a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('batch.edit', $batch->slug) }}" class="btn btn-primary btn-sm">
                                    <i data-feather="edit" style="width:16px;"></i>
                                </a>
                                <div class="btn btn-danger btn-sm"><i data-feather="trash" style="width:16px;"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="5">No Batches Found! 😢</td>
                    </tr>
                    @endforelse
                </table>
                <span class="my-3 d-block">{{ $batches->links() }}</span>
            </div>
            <div class="g-col-4">
                @if (!isset($editedBatch))
                <div class="bg-white shadow-md rounded  border-0 p-3">
                    <h4 class="fs-md fw-medium mb-3">Add New Batch</h4>
                    <form action="{{ route('batch.store') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control my-2" placeholder="Batch Name" name="name">
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <button class="d-block btn btn-primary w-full mt-3">Add Batch</button>
                    </form>
                </div>
                @else
                <div class="bg-white shadow-md rounded  border-0 p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fs-lg fw-medium ">Edit Batch</h4>
                        <a href="{{ route('batch.add') }}" class=" btn btn-primary btn-sm mt-3">Add New Batch</a>
                    </div>
                    <form action="{{ route('batch.update', $editedBatch->slug) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="text" class="form-control my-2" placeholder="Batch Name" name="name"
                            value="{{ $editedBatch->name }}">
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <button class="d-block btn btn-primary w-full mt-3">Update Batch</button>

                    </form>
                </div>
                @endif

                <div class="bg-white shadow-md rounded  border-0 p-3 mt-4">
                    <div class="d-flex  mb-3">
                        <h4 class="fs-lg fw-medium ">Add Students Batch</h4>
                    </div>
                    <form action="{{ route('student.store') }}" method="POST">
                        @csrf
                        <label for="" class="w-full">
                            Select a Batch
                            <select name="batchId" class="form-control my-2">
                                <option disabled selected>Select Batch</option>
                                @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('batchId')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <label for="" class="w-full">
                            Place Coma ( , ) for multiple names
                            <textarea style="min-height: 150px" name="studentNames" class="form-control my-3"
                                placeholder="Example: John, Smith, Harvey"></textarea>
                        </label>
                        @error('studentNames')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <button class="d-block btn btn-primary w-full mt-3">Add Students to Batch</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>