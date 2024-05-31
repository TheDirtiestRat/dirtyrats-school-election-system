<div class="row g-2 justify-content-center mb-3">
    <div class="col-12 text-center ">
        <h2>Choose you're Course or Strand, Year and Section</h2>
    </div>
    <div class="col-md-4">
        <label for="strand_or_course" class="form-label">Strand or Course</label>
        <select class="form-select" id="strand_or_course" name="strand_or_course" required>
            <option selected disabled value="">Choose...</option>
            @foreach ($courses as $course)
                <option value="{{ $course }}">{{ $course }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid Strand or Course.
        </div>
    </div>
    <div class="col-md-4">
        <label for="year" class="form-label">Year</label>
        <select class="form-select" id="year" name="year" required>
            <option selected disabled value="">Choose...</option>
            @foreach ($year as $y)
                <option value="{{ $y }}">{{ $y }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid Year.
        </div>
    </div>
    <div class="col-md-8">
        <label for="section" class="form-label">Section</label>
        <select class="form-select" id="section" name="section" required>
            <option selected disabled value="">Choose...</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
        </select>
        <div class="invalid-feedback">
            Please select a valid Section.
        </div>
    </div>
</div>


