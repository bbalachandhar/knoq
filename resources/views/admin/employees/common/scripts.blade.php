<script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(document).ready(function () {

        $("#sector").select2({});
        $("#branch").select2({});
        $("#position").select2({});
        $("#supervisor").select2({});
        $("#employment_type").select2({});
        $("#officeTime").select2({});
        $("#visa_issued_country").select2({});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.changePassword').click(function (event) {
            event.preventDefault();
            let url = $(this).data('href');
            $('.modal-title').html('{{ __('index.user_change_password') }}');
            $('#changePassword').attr('action', url);
            $('#statusUpdate').modal('show');
        });

        $('.toggleStatus').change(function (event) {
            event.preventDefault();
            let status = $(this).prop('checked') == true ? 1 : 0;
            let href = $(this).attr('href');

            Swal.fire({
                title: '{{ __('index.confirm_change_status') }}',
                showDenyButton: true,
                confirmButtonText: `{{ __('index.yes') }}`,
                denyButtonText: `{{ __('index.no') }}`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                } else if (result.isDenied) {
                    (status === 0) ? $(this).prop('checked', true) : $(this).prop('checked', false)
                }
            })
        });

        $('.toggleHolidayCheckIn').change(function (event) {
            event.preventDefault();
            let status = $(this).prop('checked') == true ? 1 : 0;
            let href = $(this).attr('href');

            Swal.fire({
                title: '{{ __('index.confirm_change_holiday_checkin') }}',
                showDenyButton: true,
                confirmButtonText: `{{ __('index.yes') }}`,
                denyButtonText: `{{ __('index.no') }}`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                } else if (result.isDenied) {
                    (status === 0) ? $(this).prop('checked', true) : $(this).prop('checked', false)
                }
            })
        });

        $('.deleteEmployee').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: '{{ __('index.confirm_delete_employee') }}',
                showDenyButton: true,
                confirmButtonText: `{{ __('index.yes') }}`,
                denyButtonText: `{{ __('index.no') }}`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });

        $('.forceLogOut').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: '{{ __('index.confirm_force_logout') }}',
                showDenyButton: true,
                confirmButtonText: `{{ __('index.yes') }}`,
                denyButtonText: `{{ __('index.no') }}`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });

        $('.changeWorkPlace').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: '{{ __('index.confirm_change_workplace') }}',
                showDenyButton: true,
                confirmButtonText: `{{ __('index.yes') }}`,
                denyButtonText: `{{ __('index.no') }}`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });



    });
    $('#export_employee').on('click', function (e) {
        e.preventDefault();
        let route = $(this).data('href');

        // Create a form data object with all current filter values
        let filtered_params = {
            employee_name: $('#employeeName').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            branch_id: $('#branch').val(),
            department_id: $('#department').val(),
            action: 'export'  // This should match what the controller is checking for
        };

        let queryString = $.param(filtered_params);
        let url = route + '?' + queryString;
        window.open(url, '_blank');
    });
    function getEmployeeFilterParam() {
        return {
            employee_name: $('#employeeName').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            branch_id: $('#branch').val(),
            department_id: $('#department').val()
        };
    }


    function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (let chr = 0; chr < str.length; chr++) {
            strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' ';
        }
        return strVal;
    }

    $('#employeeDetail').validate({
        rules: {
            name: { required: true },
            address: { required: true },
            email: { required: true },
            role_id: { required: true },
            username: { required: true },
        },
        messages: {
            name: {
                required: "{{ __('index.enter_name') }}",
            },
            address: {
                required: "{{ __('index.enter_address') }}"
            },
            email: {
                required: "{{ __('index.enter_valid_email') }}"
            },
            role_id: {
                required: "{{ __('index.select_role') }}"
            },
            username: {
                required: "{{ __('index.enter_username') }}"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('div').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
            $(element).removeClass('is-valid');
            $(element).siblings().addClass("text-danger").removeClass("text-success");
            $(element).siblings().find('span .input-group-text').addClass("bg-danger").removeClass("bg-success");
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
            $(element).siblings().addClass("text-success").removeClass("text-danger");
            $(element).find('span .input-group-prepend').addClass("bg-success").removeClass("bg-danger");
            $(element).siblings().find('span .input-group-text').addClass("bg-success").removeClass("bg-danger");
        }
    });

    $('#avatar').change(function () {
        const input = document.getElementById('avatar');
        const preview = document.getElementById('image-preview');
        const file = input.files[0];
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            preview.src = reader.result;
        }, false);
        if (file) {
            reader.readAsDataURL(file);
        }

    });



    // branch wise department, office_time etc
    $(document).ready(function () {
        const loadDepartmentsAndOfficeTime = async () => {
            const isAdmin = {{ auth('admin')->check() ? 'true' : 'false' }};
            const defaultBranchId = {{ auth()->user()->branch_id ?? 'null' }};
            const selectedBranchId = isAdmin ? $('#branch').val() : defaultBranchId;
            let departmentId = "{{ $userDetail->department_id ?? $filterParameters['department_id'] ?? old('department_id') }}";
            let officeTimeId = "{{ isset($userDetail) ? $userDetail['office_time_id'] : old('office_time_id') }}";

            if (!selectedBranchId) return;

            try {
                const response = await $.ajax({
                    type: 'GET',
                    url: `{{ url('admin/transfer/get-user-transfer-branch-data') }}/${selectedBranchId}`,
                });

                $('#sector').empty(); // Changed selector to #department
                $('#officeTime').empty(); // Added for office time

                // Departments
                if (!departmentId) {
                    $('#sector').append('<option disabled selected>{{ __('index.select_department') }}</option>');
                }
                if (response.departments && response.departments.length > 0) {
                    response.departments.forEach(department => {
                        $('#sector').append(`<option ${department.id == departmentId ? 'selected' : ''} value="${department.id}">${department.dept_name}</option>`);
                    });
                } else {
                    $('#sector').append('<option disabled>{{ __("index.no_department_found") }}</option>');
                }

                // Office Times
                if (!officeTimeId) {
                    $('#officeTime').append('<option value="" selected>{{ __('index.select_office_time') }}</option>');
                }
                if (response.officeTimes && response.officeTimes.length > 0) {
                    response.officeTimes.forEach(shift => {
                        $('#officeTime').append(`<option ${shift.id == officeTimeId ? 'selected' : ''} value="${shift.id}">${shift.opening_time} - ${shift.closing_time}</option>`);
                    });
                } else {
                    $('#officeTime').append('<option disabled>{{ __("index.office_time_not_found") }}</option>');
                }
            } catch (error) {
                $('#sector').append('<option disabled>{{ __('index.error_loading_departments') }}</option>');
                $('#officeTime').append('<option disabled>{{ __("index.error_loading_office_times") }}</option>');
            }
        };

        const loadSupervisorAndPosts = async () => {
            const selectedDepartmentId = $('#sector').val(); // Changed selector to #department
            let supervisorId = "{{ isset($userDetail) ? $userDetail['supervisor_id'] : old('supervisor_id') }}";
            let employeeId = "{{ isset($userDetail) ? $userDetail['id'] : ''  }}";
            let postId = "{{ isset($userDetail) ? $userDetail['post_id'] : old('post_id') }}";

            if (!selectedDepartmentId) return;

            try {
                const response = await fetch(`{{ url('admin/transfer/get-user-transfer-department-data') }}/${selectedDepartmentId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });

                let data = await response.json();

                $('#supervisor').empty(); // Changed selector to #supervisor
                $('#position').empty(); // Changed selector to #post

                // Supervisors
                if (!supervisorId) {
                    $('#supervisor').append('<option value="" selected>{{ __('index.select_supervisor') }}</option>');
                }
                if (data.supervisors && data.supervisors.length > 0) {
                    data.supervisors.forEach(user => {
                        if (employeeId != user.id){
                            $('#supervisor').append(`<option ${user.id == supervisorId ? 'selected' : ''} value="${user.id}">${user.name}</option>`);

                        }
                    });
                } else {
                    $('#supervisor').append('<option disabled>{{ __("index.no_employees_found") }}</option>');
                }

                // Positions
                if (!postId) {
                    $('#position').append('<option value="" selected>{{ __('index.select_option') }}</option>');
                }
                if (data.posts && data.posts.length > 0) {
                    data.posts.forEach(post => {
                        $('#position').append(`<option ${post.id == postId ? 'selected' : ''} value="${post.id}">${post.post_name}</option>`);
                    });
                } else {
                    $('#position').append('<option disabled>{{ __("index.no_posts_found") }}</option>');
                }
            } catch (error) {
                $('#supervisor').append('<option disabled>{{ __("index.error_loading_employees") }}</option>');
                $('#position').append('<option disabled>{{ __("index.error_loading_posts") }}</option>');
            }
        };

        const loadLeaveTypes = async () => {
            const gender = $('#gender').val();
            const branch = isAdmin ? $('#branch').val() : defaultBranchId;
            if (!gender || !branch) {
                $('#leave-types-table').html('');
                return;
            }

            // Preserve existing values before reloading
            let existing = {};
            $('#leave-types-table tr').each(function() {
                const idInput = $(this).find('input[name^="leave_type_id"]');
                if (idInput.length) {
                    const id = idInput.val();
                    existing[id] = {
                        days: $(this).find('input[name^="days"]').val(),
                        active: $(this).find('input[name^="is_active"]').is(':checked') ? 1 : 0
                    };
                }
            });

            try {
                const response = await $.ajax({
                    url: `{{ url('admin/leaves/get-gender-leave-types') }}/${branch}/${gender}`,
                    method: 'GET',
                });

                const leaveTypes = response.leaveTypes || [];
                let tableBody = '';

                if (leaveTypes.length) {
                    leaveTypes.forEach((leaveType, index) => {
                        tableBody += `
                <tr>
                    <td>
                        ${capitalize(leaveType.name)}
                        <input type="hidden" name="leave_type_id[${index}]" value="${leaveType.id}">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control leave-days"
                               value=""
                               oninput="validity.valid || (value='');"
                               placeholder="{{ __('index.total_leave_days') }}"
                               name="days[${index}]">
                        <span class="error-message" style="display: none; color: red;">{{ __('index.required_field') }}</span>
                    </td>
                    <td>
                        <input class="me-1 is-active-checkbox" type="checkbox"
                               name="is_active[${index}]" value="1">{{ __('index.is_active') }}
                        </td>
                    </tr>`;
                    });
                } else {
                    tableBody = '<tr><td colspan="3">{{ __("index.no_leave_types_found") }}</td></tr>';
                }

                $('#leave-types-table').html(tableBody);

                // Restore preserved values to matching leave types
                $('#leave-types-table tr').each(function() {
                    const idInput = $(this).find('input[name^="leave_type_id"]');
                    if (idInput.length) {
                        const id = idInput.val();
                        if (existing[id]) {
                            $(this).find('input[name^="days"]').val(existing[id].days);
                            if (existing[id].active) {
                                $(this).find('input[name^="is_active"]').prop('checked', true);
                            }
                        }
                    }
                });

                // Dispatch event after update (assuming this is needed for listeners)
                document.dispatchEvent(new CustomEvent('leaveTypesUpdated'));

            } catch (error) {
                console.error('Error fetching leave types:', error);
                $('#leave-types-table').html('<tr><td colspan="3">{{ __("index.error_loading_leave_types") }}</td></tr>');
            }
        };

        // Capitalize helper used in leave types
        const capitalize = (str) => {
            if (!str) return '';
            return str.charAt(0).toUpperCase() + str.slice(1);
        };

        const isAdmin = {{ auth('admin')->check() ? 'true' : 'false' }};
        if (isAdmin) {
            $('#branch').on('change', () => {
                loadDepartmentsAndOfficeTime();
                loadLeaveTypes();
            }).trigger('change');
        } else {
            // non-admin: load using the default branch id
            loadDepartmentsAndOfficeTime();
            loadLeaveTypes();
        }

        $('#sector').on('change', loadSupervisorAndPosts);
        $('#gender').on('change', loadLeaveTypes).trigger('change');

        document.addEventListener('leaveTypesUpdated', attachEventListeners);


        const leaveForm = document.getElementById('employeeDetail');
        const leaveAllocatedInput = document.getElementById('leave_allocated');
        let leaveDaysInputs = document.querySelectorAll('.leave-days');
        let isActiveCheckboxes = document.querySelectorAll('.is-active-checkbox');
        const errorMessage = document.getElementById('error-message');

        // Disable HTML5 validation to let JavaScript handle it
        leaveForm.setAttribute('novalidate', true);

        // Check if required elements exist
        if (!leaveForm || !leaveAllocatedInput || !errorMessage || !leaveDaysInputs.length) {
            console.error('Required form elements are missing.');
            return;
        }

        function displayError(element, message) {
            if (!element) return;
            console.log('Displaying error for element:', element, 'Message:', message); // Debug
            element.classList.add('text-danger');
            element.textContent = message;
            element.style.display = 'block';
        }

        function hideError(element) {
            if (!element) return;
            console.log('Hiding error for element:', element); // Debug
            element.classList.remove('text-danger');
            element.textContent = '';
            element.style.display = 'none';
        }

        function validateForm(event) {
            let totalDays = 0;
            let isValid = true;

            // Calculate total leave days
            leaveDaysInputs.forEach(input => {
                const value = parseInt(input.value) || 0;
                totalDays += value;
            });

            // Check if allocated leave is less than total leave days
            const allocatedValue = parseInt(leaveAllocatedInput.value) || 0;
            console.log('Validating: Total Days:', totalDays, 'Allocated:', allocatedValue); // Debug
            if (allocatedValue < totalDays) {
                displayError(errorMessage, 'Allocated leave cannot be less than the total leave days.');
                leaveAllocatedInput.classList.add('text-danger');
                isValid = false;
            }else if(allocatedValue > totalDays){
                displayError(errorMessage, 'Allocated leave cannot be more than the total leave days.');
                leaveAllocatedInput.classList.add('text-danger');
                isValid = false;
            } else {
                hideError(errorMessage);
                leaveAllocatedInput.classList.remove('text-danger');
            }

            // Validate leave days inputs when allocated leave is greater than 0
            leaveDaysInputs.forEach((input, index) => {
                const value = input.value.trim();
                const errorElement = input.nextElementSibling;

                if (allocatedValue > 0 && !value) {
                    displayError(errorElement, 'This field is required when leave is allocated.');
                    input.classList.add('text-danger');
                    input.classList.remove('is-valid');
                    console.log('Invalid input:', input); // Debug
                    isValid = false;
                } else {
                    hideError(errorElement);
                    input.classList.remove('text-danger');
                    if (value) input.classList.add('is-valid');
                }
            });

            if (!isValid && event) {
                event.preventDefault();
                console.log('Form submission prevented, isValid:', isValid); // Debug
            }

            return isValid;
        }

        function setRequiredAttribute() {
            const allocatedValue = parseInt(leaveAllocatedInput.value) || 0;
            console.log('setRequiredAttribute called, Allocated Value:', allocatedValue); // Debug
            leaveDaysInputs.forEach((input, index) => {
                const value = input.value.trim();
                const errorElement = input.nextElementSibling;
                const isActiveCheckbox = isActiveCheckboxes[index];

                console.log(`Checking input ${index}: Value: ${value}, Allocated: ${allocatedValue}`); // Debug
                if (allocatedValue > 0 && !value) {
                    displayError(errorElement, 'This field is required when leave is allocated.');
                    input.classList.add('text-danger');
                    input.classList.remove('is-valid');
                } else {
                    hideError(errorElement);
                    input.classList.remove('text-danger');
                    if (value) input.classList.add('is-valid');
                }
            });
        }

        // Function to attach event listeners to leave days inputs and checkboxes
        function attachEventListeners() {
            leaveDaysInputs = document.querySelectorAll('.leave-days');
            isActiveCheckboxes = document.querySelectorAll('.is-active-checkbox');
            console.log('Attaching event listeners to', leaveDaysInputs.length, 'inputs'); // Debug

            leaveDaysInputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    console.log('Input changed:', input.value); // Debug
                    const isActiveCheckbox = isActiveCheckboxes[index];
                    if (!input.value.trim()) {
                        isActiveCheckbox.checked = false;
                    }
                    setRequiredAttribute();
                });
            });

            isActiveCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function () {
                    console.log('Checkbox changed:', checkbox.checked); // Debug
                    setRequiredAttribute();
                });
            });
        }

        // Initial event listeners
        leaveAllocatedInput.addEventListener('input', setRequiredAttribute);
        leaveForm.addEventListener('submit', validateForm);
        attachEventListeners();

        // Initial validation
        setRequiredAttribute();
    });



    @if(\App\Helpers\AppHelper::ifDateInBsEnabled())
    $('.joiningDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 20,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    $('.birthDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 50,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    $('.passportIssueDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 50,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    $('.passportExpiryDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 50,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    $('.visaIssuedOnDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 50,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    $('.visaExpiryDate').nepaliDatePicker({
        language: "english",
        dateFormat: "YYYY-MM-DD",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 50,
        readOnlyInput: true,
        disableAfter: "2089-12-30",
    });
    @endif

                // Passport Copies dynamic upload/preview

                let passportCopyCounter = 0; // To ensure unique IDs for hidden inputs

        

                $('#add-passport-copy-btn').on('click', function() {

                    console.log('Add Image button clicked!'); // Debugging line

                    $('#hidden-passport-copy-input').click(); // Trigger the hidden file input

                });

        

                $('#hidden-passport-copy-input').on('change', function(e) {

                    const files = e.target.files;

                    if (files.length > 0) {

                        const file = files[0]; // Only take one file at a time as per new UX

                        const maxSize = 1 * 1024 * 1024; // 1MB in bytes

        

                        if (file.size > maxSize) {

                            Swal.fire({

                                title: @json(__('index.error')),

                                text: @json(__('message.file_size_exceeded', ['max_size' => '1MB'])),

                                icon: 'error',

                                confirmButtonText: @json(__('index.ok'))

                            });

                            $(this).val(''); // Clear the file input

                            return; // Stop processing

                        }

        

                        const reader = new FileReader();

                        reader.onload = function(e) {

                            const previewHtml = `

                                <div class="passport-copy-item d-inline-block position-relative me-2 mb-2">

                                    <img src="${e.target.result}" alt="Passport Copy" class="img-thumbnail" width="100" height="100">

                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-new-passport-copy" data-file-id="${passportCopyCounter}">X</button>

                                    <input type="file" name="passport_copies[${passportCopyCounter}]" style="display:none;">

                                </div>

                            `;

                            $('#passport-copies-container').append(previewHtml);

        

                            // Attach the actual file to the dynamically created hidden input

                            const dataTransfer = new DataTransfer();

                            dataTransfer.items.add(file);

                            $('input[name="passport_copies[' + passportCopyCounter + ']"]').prop('files', dataTransfer.files);

        

                            passportCopyCounter++;

                        };

                        reader.readAsDataURL(file);

                    }

                    // Clear the hidden file input to allow selecting the same file again if needed

                    $(this).val('');

                });

        

                // Remove dynamically added new passport copy

                $(document).on('click', '.remove-new-passport-copy', function() {

                    $(this).closest('.passport-copy-item').remove();

                });

        

                // Remove existing passport copy (AJAX call to backend needed)

                $(document).on('click', '.remove-existing-passport-copy', function() {

                    const attachmentId = $(this).data('attachment-id');

                    const itemToRemove = $(this).closest('.passport-copy-item');

        

                    // Confirm with user before deleting

                    Swal.fire({

                        title: @json(__('index.confirm_delete')),

                        text: @json(__('index.confirm_delete_passport_copy')),

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#d33',

                        cancelButtonColor: '#3085d6',

                        confirmButtonText: @json(__('index.yes_delete_it'))

                    }).then((result) => {

                        if (result.isConfirmed) {

                            // Perform AJAX delete

                            $.ajax({

                                url: `/admin/employees/passport-attachment/${attachmentId}`, // Create this route in web.php

                                type: 'DELETE',

                                success: function(response) {

                                    if (response.success) {

                                        itemToRemove.remove();

                                        Swal.fire(

                                            @json(__('index.deleted')),

                                            @json(__('index.passport_copy_deleted')),

                                            'success'

                                        );

                                    } else {

                                        Swal.fire(

                                            @json(__('index.error')),

                                            response.message || @json(__('index.failed_to_delete_passport_copy')),

                                            'error'

                                        );

                                    }

                                },

                                error: function(xhr) {

                                    Swal.fire(

                                        @json(__('index.error')),

                                        xhr.responseJSON.message || @json(__('index.failed_to_delete_passport_copy')),

                                        'error'

                                    );

                                }

                            });

                        }

                    });

                });

        

                // Visa Copies dynamic upload/preview

                let visaCopyCounter = 0; // To ensure unique IDs for hidden inputs

        

                $('#add-visa-copy-btn').on('click', function() {

                    $('#hidden-visa-copy-input').click(); // Trigger the hidden file input

                });

        

                $('#hidden-visa-copy-input').on('change', function(e) {

                    const files = e.target.files;

                    if (files.length > 0) {

                        const file = files[0]; // Only take one file at a time as per new UX

                        const maxSize = 1 * 1024 * 1024; // 1MB in bytes

        

                        if (file.size > maxSize) {

                            Swal.fire({

                                title: @json(__('index.error')),

                                text: @json(__('message.file_size_exceeded', ['max_size' => '1MB'])),

                                icon: 'error',

                                confirmButtonText: @json(__('index.ok'))

                            });

                            $(this).val(''); // Clear the file input

                            return; // Stop processing

                        }

        

                        const reader = new FileReader();

                        reader.onload = function(e) {

                            const previewHtml = `

                                <div class="visa-copy-item d-inline-block position-relative me-2 mb-2">

                                    <img src="${e.target.result}" alt="Visa Copy" class="img-thumbnail" width="100" height="100">

                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-new-visa-copy" data-file-id="${visaCopyCounter}">X</button>

                                    <input type="file" name="visa_copies[${visaCopyCounter}]" style="display:none;">

                                </div>

                            `;

                            $('#visa-copies-container').append(previewHtml);

        

                            // Attach the actual file to the dynamically created hidden input

                            const dataTransfer = new DataTransfer();

                            dataTransfer.items.add(file);

                            $('input[name="visa_copies[' + visaCopyCounter + ']"]').prop('files', dataTransfer.files);

        

                            visaCopyCounter++;

                        };

                        reader.readAsDataURL(file);

                    }

                    // Clear the hidden file input to allow selecting the same file again if needed

                    $(this).val('');

                });

        

                // Remove dynamically added new visa copy

                $(document).on('click', '.remove-new-visa-copy', function() {

                    $(this).closest('.visa-copy-item').remove();

                });

        

                // Remove existing visa copy (AJAX call to backend needed)

                $(document).on('click', '.remove-existing-visa-copy', function() {

                    const attachmentId = $(this).data('attachment-id');

                    const itemToRemove = $(this).closest('.visa-copy-item');

        

                    // Confirm with user before deleting

                    Swal.fire({

                        title: @json(__('index.confirm_delete')),

                        text: @json(__('index.confirm_delete_visa_copy')), // Need to add this translation

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#d33',

                        cancelButtonColor: '#3085d6',

                        confirmButtonText: @json(__('index.yes_delete_it'))

                    }).then((result) => {

                        if (result.isConfirmed) {

                            // Perform AJAX delete

                            $.ajax({

                                url: `/admin/employees/visa-attachment/${attachmentId}`, // Create this route in web.php

                                type: 'DELETE',

                                success: function(response) {

                                    if (response.success) {

                                        itemToRemove.remove();

                                        Swal.fire(

                                            @json(__('index.deleted')),

                                            @json(__('index.visa_copy_deleted')), // Need to add this translation

                                            'success'

                                        );

                                    } else {

                                        Swal.fire(

                                            @json(__('index.error')),

                                            response.message || @json(__('index.failed_to_delete_visa_copy')), // Need to add this translation

                                            'error'

                                        );

                                    }

                                },

                                error: function(xhr) {

                                    Swal.fire(

                                        @json(__('index.error')),

                                        xhr.responseJSON.message || @json(__('index.failed_to_delete_visa_copy')), // Need to add this translation

                                        'error'

                                    );

                                }

                            });

                        }

                    });

                });

        
</script>
