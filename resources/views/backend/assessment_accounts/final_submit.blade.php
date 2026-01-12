@extends('backend.layouts.app')

@section('title', __('Final Submit').' | '.app_name())

@section('content')
<form method="POST"
      action="{{ route('admin.assessment_accounts.final-submit-store') }}"
      enctype="multipart/form-data"
      class="form-horizontal">
    @csrf

    <input type="hidden" name="course_id" value="{{ $course_id }}"/>

    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header">
            <h4 class="mb-0">Final Submission</h4>
        </div>
        
        {{-- Body --}}
        <div class="card-body">

            {{-- Course Weightage --}}
            <div class="mb-4">
                <h5 class="mb-1">Course Module Weightage</h5>
                <p class="text-muted mb-4">
                    Total weightage must be exactly <strong>100%</strong>
                </p>

                {{-- Minimum Marks --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">
                            Minimum percentage required to qualify
                        </label>
                        <input type="number"
                               name="marks_required"
                               class="form-control"
                               min="1"
                               max="100"
                               placeholder="e.g. 60">
                    </div>
                </div>

                <hr>

                {{-- Lesson Module --}}
                @if($course->is_online === 'Online')
                <div class="row align-items-center mb-3">
                    <label class="col-md-4 col-form-label">
                        Lesson Module
                    </label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number"
                                   class="form-control module-weight"
                                   name="course_module_weight[LessonModule]"
                                   min="0" max="100"
                                   placeholder="e.g. 50">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Question Module --}}
                <div class="row align-items-center mb-3">
                    <label class="col-md-4 col-form-label">
                        Question Module
                    </label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number"
                                   class="form-control module-weight"
                                   name="course_module_weight[QuestionModule]"
                                   min="0" max="100"
                                   placeholder="e.g. 30">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>

                {{-- Feedback Module --}}
                <div class="row align-items-center mb-3">
                    <label class="col-md-4 col-form-label">
                        Feedback Module
                    </label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number"
                                   class="form-control module-weight"
                                   name="course_module_weight[FeedbackModule]"
                                   min="0" max="100"
                                   placeholder="e.g. 20">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>

                {{-- Total --}}
                <div class="mt-3">
                    <strong>Total:</strong>
                    <span id="totalWeight" class="badge bg-secondary ms-2">
                        0%
                    </span>
                </div>

                <div id="weightError" class="text-danger mt-2 d-none">
                    Total weightage must be exactly 100%
                </div>
            </div>

            <hr>

            {{-- Confirmation --}}
            <p class="mb-0">
                Are you sure you want to submit this final page?
            </p>

        </div>

        {{-- Footer --}}
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.courses.index') }}"
               class="btn btn-outline-danger">
                Cancel
            </a>

            <button type="submit" class="btn btn-success">
                Final Submit
            </button>
        </div>

    </div>
</form>

{{-- Styling --}}
<style>
    .module-weight {
        max-width: 120px;
        text-align: right;
    }
</style>

{{-- Script --}}
<script>
    document.querySelectorAll('.module-weight').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    function calculateTotal() {
        let total = 0;

        document.querySelectorAll('.module-weight').forEach(input => {
            total += Number(input.value) || 0;
        });

        const badge = document.getElementById('totalWeight');
        const error = document.getElementById('weightError');

        badge.innerText = total + '%';

        if (total === 100) {
            badge.className = 'badge bg-success ms-2';
            error.classList.add('d-none');
        } else {
            badge.className = 'badge bg-danger ms-2';
            error.classList.remove('d-none');
        }
    }
</script>
@stop
