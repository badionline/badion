{{-- <!-- resources/views/components/file-upload.blade.php --> --}}

@props(['name', 'labelid', 'label', 'accept'])

<div class="col-sm mt-0">
    <div class="form-group">
        <label for="{{ $name }}" class="btn form-control button"
            id="{{ $labelid }}">{{ $label }}</label>
        <input type="file" id="{{ $name }}" class="form-control" name="{{ $name }}" style="display:none;"
            accept="{{ $accept }}" onchange="displayFileName('{{ $name }}', '{{ $labelid }}')">
    </div>
    <span class="text-danger">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>

<script>
    function displayFileName(inputId, labelId) {
        // Get the selected file input element
        var fileInput = document.getElementById(inputId);

        // Get the label element
        var labelElement = document.getElementById(labelId);

        // Display the selected file name in the label
        labelElement.textContent = fileInput.files[0].name;

        // Optionally, you can choose to hide the file input after selecting a file
        // fileInput.style.display = "none";
    }
</script>
