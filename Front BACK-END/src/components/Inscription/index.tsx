"use client";

import React, { useState } from 'react';
import Breadcrumb from "@/components/Breadcrumbs/Breadcrumb";
import InputGroup from '../InputGroup';

export default function WizardFormBasic() {
  const [currentStep, setCurrentStep] = useState(1);
  const [formData, setFormData] = useState({
    student_last_name: '',
    student_first_name: '',
    dateNaissance: '',
    student_sex: '',
    new_class: '',
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const nextStep = () => {
    setCurrentStep((prevStep) => prevStep + 1);
  };

  const prevStep = () => {
    if (currentStep > 1) {
      setCurrentStep((prevStep) => prevStep - 1);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('/inscriptions', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });

      if (response.ok) {
        const data = await response.json();
        alert('Inscription réussie !');
      } else {
        alert('Erreur lors de l\'inscription.');
      }
    } catch (error) {
      console.error('Erreur :', error);
      alert('Une erreur est survenue.');
    }
  };

  return (
    <>
      <Breadcrumb pageName="Inscription Elève" />

      <div className="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div className="flex flex-col gap-9">
          <div className="rounded-[10px] border border-stroke bg-white shadow-1 dark:border-dark-3 dark:bg-gray-dark dark:shadow-card">
            <div className="border-b border-stroke px-6.5 py-4 dark:border-dark-3">
              <h3 className="font-medium text-dark dark:text-white"></h3>
            </div>

            <form
              className="nk-wizard nk-wizard-simple is-alter flex flex-col gap-5.5 p-6.5"
              onSubmit={handleSubmit}
            >
              {currentStep === 1 && (
                <div>
                  <h5>INFORMATIONS PERSONNELLES</h5><br />
                  <div className="row gy-3">
                    <div className="p-6.5">
                      <div className="mb-4.5 flex flex-col gap-4.5 xl:flex-row">
                        <InputGroup
                          label="Nom"
                          type="text"
                          name="student_last_name"
                          value={formData.student_last_name}
                          onChange={handleChange}
                          customClasses="w-full xl:w-1/2"
                        />

                        <InputGroup
                          label="Prénoms"
                          type="text"
                          name="student_first_name"
                          value={formData.student_first_name}
                          onChange={handleChange}
                          customClasses="w-full xl:w-1/2"
                        />
                      </div>

                      <div className="mb-4.5 flex flex-col gap-4.5 xl:flex-row">
                        <InputGroup
                          label="Date de naissance"
                          type="date"
                          name="dateNaissance"
                          value={formData.dateNaissance}
                          onChange={handleChange}
                          customClasses="w-full xl:w-1/2"
                        />

                        <div className="col-md-6">
                          <label className="mb-3 block text-body-sm font-medium text-dark dark:text-white">
                            Sexe
                          </label>
                          <label className="flex items-center space-x-2">
                            <input
                              type="radio"
                              name="student_sex"
                              value="feminin"
                              checked={formData.student_sex === 'feminin'}
                              onChange={handleChange}
                              className="h-5 w-5 rounded-full border-stroke bg-transparent text-primary focus:ring-primary dark:border-dark-3 dark:bg-dark-2 dark:focus:ring-primary"
                            />
                            <span className="text-dark dark:text-white">Féminin</span>

                            <input
                              type="radio"
                              name="student_sex"
                              value="masculin"
                              checked={formData.student_sex === 'masculin'}
                              onChange={handleChange}
                              className="h-5 w-5 rounded-full border-stroke bg-transparent text-primary focus:ring-primary dark:border-dark-3 dark:bg-dark-2 dark:focus:ring-primary"
                            />
                            <span className="text-dark dark:text-white">Masculin</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div><br />
                  <button type="button" onClick={nextStep} className="btn btn-primary">
                    Next
                  </button>
                </div>
              )}

              {currentStep === 2 && (
                <div>
                  <h5>INFORMATIONS ACADEMIQUES</h5><br />
                  <div className="row gy-3">
                    <div>
                      <label className="mb-3 block text-body-sm font-medium text-dark dark:text-white">
                        Classe
                      </label>
                      <select
                        name="new_class"
                        value={formData.new_class}
                        onChange={handleChange}
                        className="w-full rounded-[7px] border-[1.5px] border-stroke bg-transparent px-5.5 py-3 text-dark outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
                      >
                        <option value=""></option>
                      </select>
                    </div>

                    <div className="row gy-3">
                      <label className="mb-3 block text-body-sm font-medium text-dark dark:text-white">
                        Acte de naissance (Photo ou PDF)
                      </label>
                      <input
                        type="file"
                        className="w-full cursor-pointer rounded-[7px] border-[1.5px] border-stroke bg-transparent outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-[#E2E8F0] file:px-6.5 file:py-[13px] file:text-body-sm file:font-medium file:text-dark-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-dark dark:border-dark-3 dark:bg-dark-2 dark:file:border-dark-3 dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      />
                    </div>

                    <div className="row gy-3">
                      <label className="mb-3 block text-body-sm font-medium text-dark dark:text-white">
                        Bulletin de passage (Photo ou PDF)
                      </label>
                      <input
                        type="file"
                        className="w-full cursor-pointer rounded-[7px] border-[1.5px] border-stroke bg-transparent outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-[#E2E8F0] file:px-6.5 file:py-[13px] file:text-body-sm file:font-medium file:text-dark-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-dark dark:border-dark-3 dark:bg-dark-2 dark:file:border-dark-3 dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      />
                    </div>
                    
                    <div className="row gy-3">
                      <button type="button" onClick={prevStep} className="btn btn-secondary">
                        Back
                      </button>

                      <button type="submit" className="btn btn-success">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              )}
            </form>
          </div>
        </div>
      </div>
    </>
  );
}


