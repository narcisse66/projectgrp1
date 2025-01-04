"use client";
import Breadcrumb from "@/components/Breadcrumbs/Breadcrumb";
import ButtonDefault from "@/components/Buttons/ButtonDefault";


const Reinscription = () => {
  return (
    <>
      <Breadcrumb pageName="Réinscription Elève" />

      <div className="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div className="flex flex-col gap-9">
          {/* <!-- Input Fields --> */}
          <div className="rounded-[10px] border border-stroke bg-white shadow-1 dark:border-dark-3 dark:bg-gray-dark dark:shadow-card">
            <div className="border-b border-stroke px-6.5 py-4 dark:border-dark-3">
              <h3 className="font-medium text-dark dark:text-white">
               
              </h3>
            </div>
            <div className="flex flex-col gap-5.5 p-6.5">
              
              <ButtonDefault
              label="Réinscrire"
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

export default Reinscription;
