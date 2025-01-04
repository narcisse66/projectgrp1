"use client";

import React, { useState } from 'react';
import Breadcrumb from "@/components/Breadcrumbs/Breadcrumb";
import ButtonDefault from "@/components/Buttons/ButtonDefault";
import InputGroup from '../InputGroup';

const WizardFormBasic = () => {
  const [currentStep, setCurrentStep] = useState(1);

  // Passer à l'étape suivante
  const nextStep = () => {
    setCurrentStep((prevStep) => prevStep + 1);
  };

  // Revenir à l'étape précédente
  const prevStep = () => {
    if (currentStep > 1) {
      setCurrentStep((prevStep) => prevStep - 1);
    }
  };

  // Soumettre le formulaire
  const handleSubmit = (e: { preventDefault: () => void; }) => {
    e.preventDefault();
    alert('Form submitted!');
  };

  return (

    <>
      <Breadcrumb pageName="Mes enfants" />

      <div className="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div className="flex flex-col gap-9">
          {/* <!-- Input Fields --> */}
          <div className="rounded-[10px] border border-stroke bg-white shadow-1 dark:border-dark-3 dark:bg-gray-dark dark:shadow-card">
            <div className="border-b border-stroke px-6.5 py-4 dark:border-dark-3">
              <h3 className="font-medium text-dark dark:text-white"></h3>
            </div>

            <form className="nk-wizard nk-wizard-simple is-alter flex flex-col gap-5.5 p-6.5" onSubmit={handleSubmit}>
              {/* Étape 1 */}
              {currentStep === 1 && (
                <div>
                  <h5>INFORMATIONS PERSONNELLES DE L'ENFANT</h5><br />
                  <div className="row gy-3">
                    <div className="p-6.5">
                      <div className="mb-4.5 flex flex-col gap-4.5 xl:flex-row">
                        <InputGroup
                          label="Nom"
                          type="text"
                          placeholder=""
                          customClasses="w-full xl:w-1/2"
                        />

                        <InputGroup
                          label="Prénoms"
                          type="text"
                          placeholder=""
                          customClasses="w-full xl:w-1/2"
                        />
                      </div>

                      <div className="mb-4.5 flex flex-col gap-4.5 xl:flex-row">
                        <InputGroup
                          label="Date de naissance"
                          type="date"
                          placeholder=""
                          customClasses="w-full xl:w-1/2"
                        />

                        <InputGroup
                          label="Sexe"
                          type="text"
                          placeholder=""
                          customClasses="w-full xl:w-1/2"
                        />

                        <InputGroup
                          label="Nouvelle classe"
                          type="text"
                          placeholder=""
                          customClasses="w-full xl:w-1/2"
                        />

                        <ButtonDefault
                          label="Réinscrire"
                          link="/"
                          customClasses="border border-green text-green rounded-[5px] px-10 py-3.5 lg:px-8 xl:px-10"
                        />
                      </div>
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
};

export default WizardFormBasic;
