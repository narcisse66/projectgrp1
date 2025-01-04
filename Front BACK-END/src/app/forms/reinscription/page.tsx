import React from "react";
import Eleves from "@/components/Reinscription";
import { Metadata } from "next";
import DefaultLayout from "@/components/Layouts/DefaultLaout";

export const metadata: Metadata = {
  title: "Projet NextJst",
  description: "This is Next.js Form Elements page for NextAdmin Dashboard Kit",
};

const reinscriptionPage = () => {
  return (
    <DefaultLayout>
      <Eleves/>
    </DefaultLayout>
  );
};

export default reinscriptionPage;
