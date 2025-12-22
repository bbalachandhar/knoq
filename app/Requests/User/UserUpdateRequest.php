<?php
namespace App\Requests\User;


use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'joining_date' => $this->input('joining_date') ? AppHelper::getEnglishDate($this->input('joining_date')) : null,
            'dob' => $this->input('dob') ? AppHelper::getEnglishDate($this->input('dob')) : null,
            'passport_issue_date' => $this->input('passport_issue_date') ? AppHelper::getEnglishDate($this->input('passport_issue_date')) : null,
            'passport_expiry_date' => $this->input('passport_expiry_date') ? AppHelper::getEnglishDate($this->input('passport_expiry_date')) : null,
            'visa_issued_on' => $this->input('visa_issued_on') ? AppHelper::getEnglishDate($this->input('visa_issued_on')) : null,
            'visa_expiry_date' => $this->input('visa_expiry_date') ? AppHelper::getEnglishDate($this->input('visa_expiry_date')) : null,
        ]);
        if (!auth('admin')->check() && auth()->check()) {
            $this->merge(['branch_id' => auth()->user()->branch_id]);
        }

    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|min:2',
            'email' => ['required','email', Rule::unique('users')->ignore($this->employee)],
            'username' => ['required','string', Rule::unique('users')->ignore($this->employee)],
            'address' => 'nullable|required_unless:role_id,1',
            'dob' => 'nullable|required_unless:role_id,1|date|before:today',
            'phone' => 'nullable|required_unless:role_id,1|numeric',
            'gender' => ['nullable','required_unless:role_id,1', 'string', Rule::in(User::GENDER)],
            'marital_status' => ['nullable','required_unless:role_id,1', 'string', Rule::in(User::MARITAL_STATUS)],
            'employment_type' => ['nullable','required_unless:role_id,1', 'string', Rule::in(User::EMPLOYMENT_TYPE)],
            'joining_date' => 'nullable|date|before_or_equal:today',
            'role_id' => 'required|exists:roles,id',
            'branch_id' => 'nullable|required_unless:role_id,1|exists:branches,id',
            'department_id' => 'nullable|required_unless:role_id,1|exists:departments,id',
            'post_id' => 'nullable|required_unless:role_id,1|exists:posts,id',
            'supervisor_id' => 'nullable|exists:users,id',
            'office_time_id' => 'nullable|required_unless:role_id,1|exists:office_times,id',
            'leave_allocated' => 'nullable|numeric|gte:0',
            'remarks' => 'nullable|string|max:1000',
            'workspace_type' => ['nullable', 'boolean', Rule::in([1, 0])],
            'avatar' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg','max:5048'],
            'employee_code' => ['nullable'],
            'allow_holiday_check_in' => ['nullable'],
            'passport_issue_date' => 'nullable|date',
            'passport_expiry_date' => 'nullable|date|after:passport_issue_date',
            'passport_number' => 'nullable|string',
            'place_of_issue' => 'nullable|string',
            'nationality' => 'nullable|string',
            'passport_copies' => 'nullable|array',
            'passport_copies.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:1024',
            'visa_issued_country' => 'nullable|string',
            'visa_issued_on' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date|after:visa_issued_on',
            'visa_copies' => 'nullable|array',
            'visa_copies.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:1024',
            'visa_brp_number' => 'nullable|string',
            'share_code' => 'nullable|string',
            'national_insurance_number' => 'nullable|string',
        ];

    }

    public function messages()
    {
        return [
            'required_unless' => 'The :attribute field is required',
        ];
    }

    public function attributes()
    {
        return [
            'dob' => 'date of birth',
            'phone' => 'phone number',
            'gender' => 'gender',
            'marital_status' => 'marital status',
            'employment_type' => 'employment type',
            'branch_id' => 'branch',
            'department_id' => 'department',
            'post_id' => 'post',
            'office_time_id' => 'office time',
        ];
    }

}















