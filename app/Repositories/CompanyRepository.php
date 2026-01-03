<?php

namespace App\Repositories;

use App\Models\Company;
use App\Traits\ImageService;

class CompanyRepository
{
    use ImageService;

    public function findOrFailCompanyDetailById($id,$select=['*'], $with=[])
    {
        return Company::with($with)
            ->select($select)
            ->where('id',$id)
            ->firstOrFail();
    }

    public function getCompanyDetail($select=['*'],$with=[])
    {
        return Company::with($with)->select($select)->first();
    }


    public function store($validatedData)
    {
        if(isset($validatedData['logo'])){
            $validatedData['logo'] = $this->storeImage($validatedData['logo'],Company::UPLOAD_PATH);
        }
        if(isset($validatedData['sidebar_logo'])){
            $validatedData['sidebar_logo'] = $this->storeImage($validatedData['sidebar_logo'],Company::UPLOAD_PATH);
        }

        return Company::create($validatedData)->fresh();
    }

    public function update($companyDetail, $validatedData)
    {
        if(isset($validatedData['logo'])){
            if($companyDetail['logo'] != 'placeholder_logo.svg') {
                $this->removeImage(Company::UPLOAD_PATH, $companyDetail['logo']);
            }
            $validatedData['logo'] = $this->storeImage($validatedData['logo'],Company::UPLOAD_PATH);
        }

        if(isset($validatedData['sidebar_logo'])){
            if($companyDetail['sidebar_logo'] != 'placeholder_logo.svg') {
                $this->removeImage(Company::UPLOAD_PATH, $companyDetail['sidebar_logo']);
            }
            $validatedData['sidebar_logo'] = $this->storeImage($validatedData['sidebar_logo'],Company::UPLOAD_PATH);
        }
        return $companyDetail->update($validatedData);
    }

}
