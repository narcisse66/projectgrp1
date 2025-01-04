 "use client";
import Link from "next/link";
import React from "react";
import GoogleSigninButton from "../GoogleSigninButton";
import SigninWithPassword from "../SigninWithPassword";

export default function Connexion() {
  return (
    <>
      <div>
        <SigninWithPassword />
      </div>

      <div className="mt-6 text-center">
        <p>
          Vous n'avez pas compte?{" "}
          <Link href="/auth/inscription" className="text-primary">
            Créez un compte
          </Link>
        </p>
      </div>
    </>
  );
}
