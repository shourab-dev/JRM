@if ($errors->any())
    <div {{ $attributes }}>
        <ul class="mt-3 list-disc list-inside text-sm" style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
