"use client";
import Breadcrumb from "@/components/Breadcrumbs/Breadcrumb";
import ButtonDefault from "@/components/Buttons/ButtonDefault";


const FormElements = () => {
  return (
    <>
      <Breadcrumb pageName="Ajout Année Scolaire" />

      <div className="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div className="flex flex-col gap-9">
          {/* <!-- Input Fields --> */}
          <div className="rounded-[10px] border border-stroke bg-white shadow-1 dark:border-dark-3 dark:bg-gray-dark dark:shadow-card">
            <div className="border-b border-stroke px-6.5 py-4 dark:border-dark-3">
              <h3 className="font-medium text-dark dark:text-white">
               
              </h3>
            </div>
            <div className="flex flex-col gap-5.5 p-6.5">
              <div>
                <label className="mb-3 block text-body-sm font-medium text-dark dark:text-white">
                  Année Scolaire
                </label>
                <input
                  type="text"
                  placeholder="Ex: 2024-2025"
                  className="w-full rounded-[7px] border-[1.5px] border-stroke bg-transparent px-5.5 py-3 text-dark outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-gray-2 dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
                />
              </div>

              <ButtonDefault
              label="Enregistrer"
              link="/"
              customClasses="border border-green text-green rounded-[5px] px-10 py-3.5 lg:px-8 xl:px-10"
              />

            </div>
          </div>

         
        </div>
      </div>
    </>
  );
};

export default FormElements;
