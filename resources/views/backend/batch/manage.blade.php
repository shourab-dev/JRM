<x-backend-layout>
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
                    <th>Created At</th>
                </tr>
               </table>
            </div>
            <div class="g-col-4">
                <div class="bg-white shadow-md rounded  border-0 p-3">
                    <h4 class="fs-md fw-medium mb-3">Add New Batch</h4>
                    <form action="" method="POST">
                        @csrf
                        <input type="text" class="form-control my-2" placeholder="Batch Name">
                        <button class="d-block btn btn-primary w-full mt-3">Add Batch</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>