"use client";
import  Dashboard  from "@/components/Dashboard/index";
import React, { useEffect } from "react";
import { usePathname, useSearchParams, useParams } from 'next/navigation';

const dashboard: React.FC = () => {
  useEffect(() => {
    const token = localStorage.getItem('authToken');
    if (!token) {
      // Redirect to login page if token is not found
      window.location.href = '/auth/connexion';
    }
  }, []);

  return (
    <>
      <h1>Welcome to the Dashboard</h1>
      <Dashboard/>
    </>
  );
};


export default dashboard;
