import Layout from "@/components/Layout";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Construction } from "lucide-react";

interface PlaceholderProps {
  title: string;
  description: string;
}

export default function Placeholder({ title, description }: PlaceholderProps) {
  return (
    <Layout>
      <div className="min-h-[60vh] flex items-center justify-center py-16">
        <Card className="max-w-md mx-auto text-center">
          <CardContent className="p-8">
            <Construction className="h-16 w-16 text-colmena-yellow mx-auto mb-4" />
            <h1 className="text-2xl font-bold text-colmena-indigo mb-4">
              {title}
            </h1>
            <p className="text-gray-600 mb-6">
              {description}
            </p>
            <Button 
              className="bg-colmena-indigo hover:bg-colmena-indigo/90 text-white"
              onClick={() => window.history.back()}
            >
              Volver Atrás
            </Button>
          </CardContent>
        </Card>
      </div>
    </Layout>
  );
}
