import { useLocation, Link } from "react-router-dom";
import { useEffect } from "react";
import Layout from "@/components/Layout";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Home } from "lucide-react";

const NotFound = () => {
  const location = useLocation();

  useEffect(() => {
    console.error(
      "404 Error: User attempted to access non-existent route:",
      location.pathname,
    );
  }, [location.pathname]);

  return (
    <Layout>
      <div className="min-h-[60vh] flex items-center justify-center py-16">
        <Card className="max-w-md mx-auto text-center">
          <CardContent className="p-8">
            <div className="text-6xl mb-4">🐝</div>
            <h1 className="text-4xl font-bold text-colmena-indigo mb-4">404</h1>
            <p className="text-gray-600 mb-8">
              ¡Ups! Esta página no existe en nuestra colmena.
            </p>
            <Link to="/">
              <Button className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold">
                <Home className="mr-2 h-4 w-4" />
                Volver al Inicio
              </Button>
            </Link>
          </CardContent>
        </Card>
      </div>
    </Layout>
  );
};

export default NotFound;
