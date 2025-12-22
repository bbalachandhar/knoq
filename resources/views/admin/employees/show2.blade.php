@extends('layouts.master')

@section('title', __('index.show_user_details'))

@section('action', __('index.detail'))

@section('button')
    <div class="d-md-flex">
        @can('edit_employee')
            <a href="{{ route('admin.employees.edit', $userDetail->id) }}">
                <button class="btn btn-secondary me-2">
                    <i class="link-icon" data-feather="edit"></i>{{ __('index.edit_detail') }}
                </button>
            </a>
        @endcan

        <a href="{{ route('admin.employees.index') }}">
            <button class="btn btn-primary "><i class="link-icon" data-feather="arrow-left"></i> {{ __('index.back') }}</button>
        </a>
    </div>
@endsection

@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')
        @include('admin.employees.common.breadcrumb')


        <div class="d-md-flex align-items-center text-md-start text-center mb-md-4 mb-2">
            <img class="wd-100 ht-100 rounded-circle" style="object-fit: cover"
                 src="{{ asset(\App\Models\User::AVATAR_UPLOAD_PATH . $userDetail->avatar) }}" alt="profile">
            <div class="ms-md-3 mt-md-0 mt-2">
                <span class="fw-bold">{{ ucfirst($userDetail->name) }}</span>
                <p class="fw-bold">{{ __('index.employee_code') }}: {{ $userDetail->employee_code }}</p>
                <p class="">{{ ucfirst($userDetail->email) }}</p>
            </div>
        </div>

        <div class="row profile-body">
            <div class="col-lg-6 mb-4 d-flex">
                <div class="card rounded w-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" style="align-content: center;">{{ __('index.user_detail') }}</h6>
                    </div>
                    <div class="card-body card-profile py-2">

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.username') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->username }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.gender') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->gender) }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.marital_status') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->marital_status) }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.national_insurance_number') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->national_insurance_number ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.address') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->address) }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.phone_number') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->phone }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.date_of_birth') }}:</label>
                                <p class="d-inline-block"> {{ isset($userDetail->dob) ? \App\Helpers\AppHelper::formatDateForView($userDetail->dob) : '' }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.role') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->role ? ucfirst($userDetail->role->name) : __('index.not_applicable') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.is_active') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->is_active == 1 ? __('index.yes') : __('index.no') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4 d-flex">
                <div class="card rounded w-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" style="align-content: center;">{{ __('index.office_detail') }}</h6>
                    </div>
                    <div class="card-body card-profile py-2">

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.branch_name') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->branch ? ucfirst($userDetail->branch->name) : __('index.not_applicable') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.department_name') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->department ? ucfirst($userDetail->department->dept_name) : __('index.not_applicable') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.post_name') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->post ? ucfirst($userDetail->post->post_name) : __('index.not_applicable') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.employment_type') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->employment_type) }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.joining_date') }}:</label>
                                <p class="d-inline-block">{{ isset($userDetail->joining_date) ? \App\Helpers\AppHelper::formatDateForView($userDetail->joining_date) : __('index.not_applicable') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.workspace') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->workspace_type == 1 ? __('index.office') : __('index.home') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4 d-flex">
                <div class="card rounded w-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" style="align-content: center;">{{ __('index.account_detail') }}</h6>
                    </div>
                    <div class="card-body card-profile py-2">

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.bank_name') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->accountDetail->bank_name ?? __('index.not_available')) }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.account_number') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->accountDetail->bank_account_no ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.account_type') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->accountDetail->bank_account_type ?? __('index.not_available')) }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.account_holder') }}:</label>
                                <p class="d-inline-block">{{ ucfirst($userDetail->accountDetail->account_holder ?? __('index.not_available')) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4 d-flex">
                <div class="card rounded w-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" style="align-content: center;">{{ __('index.passport_detail') }}</h6>
                    </div>
                    <div class="card-body card-profile py-2">

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.passport_issue_date') }}:</label>
                                <p class="d-inline-block">{{ isset($userDetail->passport_issue_date) ? \App\Helpers\AppHelper::formatDateForView($userDetail->passport_issue_date) : __('index.not_available') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.passport_expiry_date') }}:</label>
                                <p class="d-inline-block">{{ isset($userDetail->passport_expiry_date) ? \App\Helpers\AppHelper::formatDateForView($userDetail->passport_expiry_date) : __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.passport_number') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->passport_number ?? __('index.not_available') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items_center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.place_of_issue') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->place_of_issue ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.nationality') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->nationality ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="mb-2 border-bottom pb-2">
                            <div class="w-100 py-2">
                                <label class="fw-bolder mb-0 text-uppercase">{{ __('index.passport_copies') }}:</label>
                                <div class="mt-2 d-flex flex-wrap">
                                    @forelse($userDetail->passportAttachments as $attachment)
                                        <div class="me-2 mb-2">
                                            <a href="{{ asset(\App\Models\PassportAttachment::UPLOAD_PATH . $attachment->file_name) }}" target="_blank">
                                                @if(in_array($attachment->file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <img src="{{ asset(\App\Models\PassportAttachment::UPLOAD_PATH . $attachment->file_name) }}"
                                                         alt="Passport Copy" class="img-thumbnail" width="100" height="100">
                                                @else
                                                    <img src="{{ asset('assets/images/pdf_icon.png') }}"
                                                         alt="PDF Document" class="img-thumbnail" width="100" height="100">
                                                @endif
                                            </a>
                                        </div>
                                    @empty
                                        <p class="d-inline-block">{{ __('index.not_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4 d-flex">
                <div class="card rounded w-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" style="align-content: center;">{{ __('index.visa_detail') }}</h6>
                    </div>
                    <div class="card-body card-profile py-2">

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.visa_issued_country') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->visa_issued_country ?? __('index.not_available') }}</p>
                            </div>

                            <div class="w-100 py-2 d-flex align-items_center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.visa_issued_on') }}:</label>
                                <p class="d-inline-block">{{ isset($userDetail->visa_issued_on) ? \App\Helpers\AppHelper::formatDateForView($userDetail->visa_issued_on) : __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                             <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.visa_expiry_date') }}:</label>
                                <p class="d-inline-block">{{ isset($userDetail->visa_expiry_date) ? \App\Helpers\AppHelper::formatDateForView($userDetail->visa_expiry_date) : __('index.not_available') }}</p>
                            </div>
                            <div class="w-100 py-2 d-flex align-items_center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.visa_brp_number') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->visa_brp_number ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="d-md-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                            <div class="w-100 py-2 d-flex align-items-center">
                                <label class="fw-bolder mb-0 text-uppercase w-45 border-end me-4">{{ __('index.share_code') }}:</label>
                                <p class="d-inline-block">{{ $userDetail->share_code ?? __('index.not_available') }}</p>
                            </div>
                        </div>

                        <div class="mb-2 border-bottom pb-2">
                            <div class="w-100 py-2">
                                <label class="fw-bolder mb-0 text-uppercase">{{ __('index.visa_copies') }}:</label>
                                <div class="mt-2 d-flex flex-wrap">
                                    @forelse($userDetail->visaAttachments as $attachment)
                                        <div class="me-2 mb-2">
                                            <a href="{{ asset(\App\Models\VisaAttachment::UPLOAD_PATH . $attachment->file_name) }}" target="_blank">
                                                @if(in_array($attachment->file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <img src="{{ asset(\App\Models\VisaAttachment::UPLOAD_PATH . $attachment->file_name) }}"
                                                         alt="Visa Copy" class="img-thumbnail" width="100" height="100">
                                                @else
                                                    <img src="{{ asset('assets/images/pdf_icon.png') }}"
                                                         alt="PDF Document" class="img-thumbnail" width="100" height="100">
                                                @endif
                                            </a>
                                        </div>
                                    @empty
                                        <p class="d-inline-block">{{ __('index.not_available') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
