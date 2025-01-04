"use client";
import React from "react";

import DataStatsOne from "@/components/DataStats/DataStatsOne";
import DefaultLayout from "../Layouts/DefaultLaout";


const Dashboard: React.FC = () => {
  return (
    <>
    <DefaultLayout>
      <DataStatsOne />
      </DefaultLayout>
    </>
  );
};

export default Dashboard;
