import React from "react";
import { Metadata } from "next";
import DefaultLayout from "@/components/Layouts/DefaultLaout";
import Enfants from "@/components/Enfants";


export const metadata: Metadata = {
  title: "Projet NextJs",
  description: "This is Next.js Form Elements page for NextAdmin Dashboard Kit",
};

const inscriptionPage = () => {
  return (
    <DefaultLayout>
      <Enfants/>
    </DefaultLayout>
  );
};

export default inscriptionPage;
