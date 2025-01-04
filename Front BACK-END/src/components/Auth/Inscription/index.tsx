 "use client";
import Link from "next/link";
import React from "react";
import GoogleSigninButton from "../GoogleSigninButton";
import Register from "../Register";

export default function Signin() {
  return (
    <>
      <div>
        <Register />
      </div>

      <div className="mt-6 text-center">
        <p>
          Vous avez un compte?{" "}
          <Link href="/auth/connexion" className="text-primary">
            Connectez-vous
          </Link>
        </p>
      </div>
    </>
  );
}
