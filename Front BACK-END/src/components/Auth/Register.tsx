"use client";
import React, { useState } from "react";

export default function SigninWithPassword() {
  const [data, setData] = useState({
    name: "",
    email: "",
    contact: "",
    profession: "",
    password: ""
  });

  const handleSubmit = async (event: { preventDefault: () => void; }) => {
    event.preventDefault();

    const payload = {
      name: data.name,
      email: data.email,
      contact: data.contact,
      profession: data.profession,
      password: data.password
    };

    try {
      const response = await fetch(`${process.env.Backend_Url}/parents/register`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
      });

      const result = await response.json();

      if (response.ok) {
        // Traitement en cas de succès
        console.log(result.message);
      } else {
        // Gestion des erreurs
        console.error(result.message);
      }
    } catch (error) {
      console.error("Erreur lors de l'envoi des données:", error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="my-6 flex items-center justify-center">
        <span className="block h-px w-full bg-stroke dark:bg-dark-3"></span>
        <div className="block w-full min-w-fit bg-white px-3 text-center font-medium dark:bg-gray-dark">
          CREATION DE COMPTE PARENT
        </div>
        <span className="block h-px w-full bg-stroke dark:bg-dark-3"></span>
      </div>

      <div className="mb-4">
        <label
          htmlFor="name"
          className="mb-0.5 block font-medium text-dark dark:text-white"
        >
          Nom & Prénoms
        </label>
        <div className="relative">
          <input
            type="text"
            placeholder="Entrez votre nom et vore prénom"
            name="name"
            value={data.name}
            onChange={(e) => setData({ ...data, name: e.target.value })}
            className="w-full rounded-lg border border-stroke bg-transparent py-[15px] pl-6 pr-11 font-medium text-dark outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
          />
        </div>
      </div>
  
      <div className="mb-4">
        <label
          htmlFor="email"
          className="mb-0.5 block font-medium text-dark dark:text-white"
        >
          Email
        </label>
        <div className="relative">
          <input
            type="email"
            placeholder="Entrez votre email"
            name="email"
            value={data.email}
            onChange={(e) => setData({ ...data, email: e.target.value })}
            className="w-full rounded-lg border border-stroke bg-transparent py-[15px] pl-6 pr-11 font-medium text-dark outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
          />
        </div>
      </div>


<div className="mb-4">
        <label
          htmlFor="contact"
          className="mb-0.5 block font-medium text-dark dark:text-white"
        >
          Contact
        </label>
        <div className="relative">
          <input
            type="tel"
            placeholder="Entrez votre contact"
            name="contact"
            value={data.contact}
            onChange={(e) => setData({ ...data, contact: e.target.value })}
            className="w-full rounded-lg border border-stroke bg-transparent py-[15px] pl-6 pr-11 font-medium text-dark outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
          />
        </div>
      </div>

      <div className="mb-4">
        <label
          htmlFor="profession"
          className="mb-0.5 block font-medium text-dark dark:text-white"
        >
          Profession
        </label>
        <div className="relative">
          <input
            type="text"
            placeholder="Entrez votre profession"
            name="profession"
            value={data.profession}
            onChange={(e) => setData({ ...data, profession: e.target.value })}
            className="w-full rounded-lg border border-stroke bg-transparent py-[15px] pl-6 pr-11 font-medium text-dark outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
          />
        </div>
      </div>

      <div className="mb-5">
        <label
          htmlFor="password"
          className="mb-2.5 block font-medium text-dark dark:text-white"
        >
          Mot de passe
        </label>
        <div className="relative">
          <input
            type="password"
            name="password"
            placeholder="Entrez votre mot de passe"
            value={data.password}
            onChange={(e) => setData({ ...data, password: e.target.value })}
            className="w-full rounded-lg border border-stroke bg-transparent py-[15px] pl-6 pr-11 font-medium text-dark outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-3 dark:bg-dark-2 dark:text-white dark:focus:border-primary"
          />
        </div>
      </div>

      <div className="mb-4.5">
        <button
          type="submit"
          className="flex w-full cursor-pointer items-center justify-center gap-2 rounded-lg bg-primary p-4 font-medium text-white transition hover:bg-opacity-90"
        >
          S'inscrire
        </button>
      </div>
    </form>
  );
}
