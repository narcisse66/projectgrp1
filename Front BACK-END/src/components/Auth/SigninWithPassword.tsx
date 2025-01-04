"use client";

import React, { useState } from "react";
import axios from "axios";
import { useRouter } from "next/navigation"; // Pour rediriger après connexion
import Link from "next/link";

const LoginForm = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError("");

    try {
      const response = await axios.post("http://localhost:8000/api/parents/login", {
        email,
        password,
      });

      if (response.data.success) {
        // Stocker le token dans localStorage ou un autre moyen sécurisé
        localStorage.setItem("authtoken", response.data.token);

        // Redirection vers l'URL spécifiée
        router.push(response.data.redirectUrl);
      } else {
        setError("Erreur : Connexion échouée. Vérifiez vos informations.");
      }
    } catch (err: any) {
      setError(
        err.response?.data?.message || "Une erreur s'est produite. Veuillez réessayer."
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="flex justify-center items-center h-screen bg-gray-100">
      <div className="w-full max-w-sm p-6 bg-white rounded shadow-md">
        <h2 className="text-2xl font-bold text-center mb-4">Connexion</h2>

        {error && <p className="mb-4 text-red-500 text-sm">{error}</p>}

        <form onSubmit={handleSubmit}>
          <div className="mb-4">
            <label
              htmlFor="email"
              className="block text-sm font-medium text-gray-700"
            >
              Email
            </label>
            <input
              type="email"
              id="email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              required
            />
          </div>

          <div className="mb-4">
            <label
              htmlFor="password"
              className="block text-sm font-medium text-gray-700"
            >
              Mot de passe
            </label>
            <input
              type="password"
              id="password"
              name="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              required
            />
          </div>

          <button
            type="submit"
            className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            disabled={loading}
          >
            {loading ? "Connexion..." : "Se connecter"}
          </button>
          <div className="mt-6 text-center">
            <p>
              Vous n'avez pas compte?{" "}
              <Link href="/auth/inscription" className="text-primary">
                Créez un compte
              </Link>
            </p>
          </div>
        </form>
      </div>
    </div>
  );
};

export default LoginForm;
