import React from "react";
import Inscription from "@/components/Inscription";
import { Metadata } from "next";
import DefaultLayout from "@/components/Layouts/DefaultLaout";


export const metadata: Metadata = {
  title: "Projet NextJs",
  description: "This is Next.js Form Elements page for NextAdmin Dashboard Kit",
};

const inscriptionPage = () => {
  return (
    <DefaultLayout>
      <Inscription/>
    </DefaultLayout>
  );
};

export default inscriptionPage;
