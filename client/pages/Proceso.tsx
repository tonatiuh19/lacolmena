import { useState } from "react";
import { Play, Pause, CheckCircle, Timer, Thermometer, Droplets, Palette, ArrowRight, Eye } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Progress } from "@/components/ui/progress";
import Layout from "@/components/Layout";
import { Link } from "react-router-dom";

export default function Proceso() {
  const [activeStep, setActiveStep] = useState(0);
  const [isPlaying, setIsPlaying] = useState(false);

  const processSteps = [
    {
      number: "01",
      title: "Selección de Cera Pura",
      duration: "2 horas",
      temperature: "65°C",
      description: "Comenzamos con cera de abeja 100% natural, libre de químicos y aditivos artificiales.",
      details: [
        "Inspección visual de cada lote de cera",
        "Verificación de pureza mediante pruebas artesanales",
        "Filtrado natural para eliminar impurezas",
        "Calentamiento gradual en baño maría tradicional"
      ],
      image: "🍯",
      color: "from-amber-400 to-amber-600"
    },
    {
      number: "02", 
      title: "Preparación del Pabilo",
      duration: "30 minutos",
      temperature: "Ambiente",
      description: "Seleccionamos mechas de algodón 100% puro, cortadas a la medida exacta según el tamaño del cirio.",
      details: [
        "Algodón premium sin blanqueadores químicos",
        "Corte preciso según especificaciones del cirio",
        "Trenzado artesanal para óptima combustión",
        "Impregnación inicial con cera natural"
      ],
      image: "🧵",
      color: "from-white to-gray-200"
    },
    {
      number: "03",
      title: "Método de Inmersión",
      duration: "72 horas",
      temperature: "68°C",
      description: "El corazón de nuestro proceso: 72 capas de cera aplicadas una por una mediante inmersión lenta.",
      details: [
        "Primera inmersión para adherencia base",
        "72 capas sucesivas con intervalos de enfriamiento",
        "Control manual de temperatura constante",
        "Supervisión artesanal capa por capa"
      ],
      image: "🕯️",
      color: "from-colmena-yellow to-yellow-600"
    },
    {
      number: "04",
      title: "Moldeado y Forma",
      duration: "4 horas", 
      temperature: "60°C",
      description: "Damos forma final al cirio, asegurando el diámetro perfecto y la superficie lisa característica.",
      details: [
        "Moldeado manual para forma cilíndrica perfecta",
        "Alisado de superficie con técnicas tradicionales",
        "Verificación de medidas según especificaciones",
        "Enfriamiento controlado para solidificación"
      ],
      image: "⚱️",
      color: "from-orange-400 to-orange-600"
    },
    {
      number: "05",
      title: "Decoración Simbólica",
      duration: "3 horas",
      temperature: "Ambiente",
      description: "Pintamos a mano cada símbolo sagrado: cordero blanco, cruz roja con detalles dorados.",
      details: [
        "Diseño del cordero con resplandor dorado",
        "Cruz roja con símbolos Alfa y Omega",
        "Bandas decorativas doradas y rojas",
        "Año actual pintado artesanalmente"
      ],
      image: "🎨",
      color: "from-red-400 to-red-600"
    },
    {
      number: "06",
      title: "Control de Calidad",
      duration: "1 hora",
      temperature: "Ambiente", 
      description: "Inspección final rigurosa para garantizar que cada cirio cumple nuestros estándares de excelencia.",
      details: [
        "Verificación de quemado uniforme",
        "Inspección de decoración y acabados",
        "Prueba de estabilidad y durabilidad",
        "Empaque individual con certificado"
      ],
      image: "✅",
      color: "from-green-400 to-green-600"
    }
  ];

  const qualityFeatures = [
    {
      icon: Droplets,
      title: "Sin Humo",
      description: "Mechas de algodón puro garantizan combustión limpia",
      stat: "0% emisiones tóxicas"
    },
    {
      icon: Timer,
      title: "Durabilidad",
      description: "72 capas de cera aseguran máximo aprovechamiento",
      stat: "8+ horas de duración"
    },
    {
      icon: Thermometer,
      title: "Quemado Uniforme",
      description: "Temperatura controlada en todo el proceso",
      stat: "68°C constante"
    },
    {
      icon: Palette,
      title: "Arte Tradicional",
      description: "Cada símbolo pintado a mano por artesanos",
      stat: "3 horas por decoración"
    }
  ];

  const tools = [
    { name: "Caldero de Cobre", use: "Derretir cera a temperatura exacta", years: "45 años en uso" },
    { name: "Moldes Tradicionales", use: "Dar forma cilíndrica perfecta", years: "Heredados desde 1945" },
    { name: "Pinceles de Pelo Natural", use: "Pintar decoraciones simbólicas", years: "Hechos a mano" },
    { name: "Termómetro Artesanal", use: "Control de temperatura manual", years: "Calibrado por generaciones" }
  ];

  const nextStep = () => {
    setActiveStep((prev) => (prev + 1) % processSteps.length);
  };

  const prevStep = () => {
    setActiveStep((prev) => (prev - 1 + processSteps.length) % processSteps.length);
  };

  return (
    <Layout>
      <div className="min-h-screen bg-white">
        {/* Hero Section */}
        <section className="bg-gradient-to-br from-colmena-indigo via-colmena-indigo/95 to-colmena-indigo/90 py-20 relative overflow-hidden">
          <div className="absolute inset-0 opacity-10">
            <div style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFE882' fill-opacity='0.1'%3E%3Cpath d='M30 0l30 30-30 30L0 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
              backgroundSize: '60px 60px'
            }}>
            </div>
          </div>
          
          <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 className="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
              Nuestro Proceso
            </h1>
            <p className="text-xl md:text-2xl text-gray-200 mb-8 max-w-4xl mx-auto leading-relaxed">
              El arte milenario del método de inmersión, perfeccionado durante 78 años para crear 
              cirios de cera de abeja que nunca humean y duran más que cualquier otro.
            </p>
            <div className="w-32 h-1 bg-colmena-yellow mx-auto"></div>
          </div>
        </section>

        {/* Process Overview */}
        <section className="py-20 bg-colmena-gray-light">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
                72 Capas, 72 Horas de Paciencia
              </h2>
              <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                Cada cirio es una obra maestra que requiere tiempo, precisión y la experiencia de tres generaciones
              </p>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
            </div>

            {/* Process Timeline */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
              {processSteps.map((step, index) => (
                <Card 
                  key={index}
                  className={`group cursor-pointer transition-all duration-500 transform hover:scale-105 ${
                    activeStep === index 
                      ? 'ring-4 ring-colmena-yellow shadow-2xl' 
                      : 'hover:shadow-xl'
                  }`}
                  onClick={() => setActiveStep(index)}
                >
                  <CardContent className="p-6">
                    <div className="flex items-start justify-between mb-4">
                      <Badge className={`bg-gradient-to-r ${step.color} text-white font-bold text-lg px-3 py-1`}>
                        {step.number}
                      </Badge>
                      <div className="text-3xl group-hover:scale-110 transition-transform">
                        {step.image}
                      </div>
                    </div>
                    
                    <h3 className="text-lg font-bold text-colmena-indigo mb-2 group-hover:text-colmena-yellow transition-colors">
                      {step.title}
                    </h3>
                    
                    <p className="text-gray-600 text-sm mb-4">
                      {step.description}
                    </p>
                    
                    <div className="flex justify-between text-xs text-gray-500">
                      <span className="flex items-center">
                        <Timer className="h-3 w-3 mr-1" />
                        {step.duration}
                      </span>
                      <span className="flex items-center">
                        <Thermometer className="h-3 w-3 mr-1" />
                        {step.temperature}
                      </span>
                    </div>
                  </CardContent>
                </Card>
              ))}
            </div>

            {/* Active Step Detail */}
            <Card className="shadow-2xl border-2 border-colmena-yellow/50">
              <CardContent className="p-8">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                  <div>
                    <div className="flex items-center mb-6">
                      <Badge className={`bg-gradient-to-r ${processSteps[activeStep].color} text-white font-bold text-2xl px-4 py-2 mr-4`}>
                        {processSteps[activeStep].number}
                      </Badge>
                      <h3 className="text-3xl font-bold text-colmena-indigo">
                        {processSteps[activeStep].title}
                      </h3>
                    </div>
                    
                    <p className="text-lg text-gray-700 mb-6 leading-relaxed">
                      {processSteps[activeStep].description}
                    </p>
                    
                    <div className="space-y-3 mb-8">
                      {processSteps[activeStep].details.map((detail, index) => (
                        <div key={index} className="flex items-start space-x-3">
                          <CheckCircle className="h-5 w-5 text-colmena-yellow mt-0.5 flex-shrink-0" />
                          <span className="text-gray-600">{detail}</span>
                        </div>
                      ))}
                    </div>
                    
                    <div className="flex items-center space-x-6 mb-6">
                      <div className="flex items-center space-x-2">
                        <Timer className="h-5 w-5 text-colmena-yellow" />
                        <span className="font-semibold text-colmena-indigo">
                          Duración: {processSteps[activeStep].duration}
                        </span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Thermometer className="h-5 w-5 text-colmena-yellow" />
                        <span className="font-semibold text-colmena-indigo">
                          Temperatura: {processSteps[activeStep].temperature}
                        </span>
                      </div>
                    </div>
                    
                    <div className="flex space-x-4">
                      <Button 
                        onClick={prevStep}
                        variant="outline"
                        className="border-colmena-indigo text-colmena-indigo hover:bg-colmena-indigo hover:text-white"
                      >
                        ← Anterior
                      </Button>
                      <Button 
                        onClick={nextStep}
                        className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90"
                      >
                        Siguiente →
                      </Button>
                    </div>
                  </div>
                  
                  <div className="text-center">
                    <div className="text-9xl mb-6 animate-pulse">
                      {processSteps[activeStep].image}
                    </div>
                    <Progress 
                      value={((activeStep + 1) / processSteps.length) * 100} 
                      className="w-full mb-4"
                    />
                    <p className="text-sm text-gray-500">
                      Paso {activeStep + 1} de {processSteps.length}
                    </p>
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>
        </section>

        {/* Quality Features */}
        <section className="py-20 bg-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
                Características de Calidad
              </h2>
              <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                El resultado de nuestro proceso artesanal son cirios con características únicas
              </p>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              {qualityFeatures.map((feature, index) => (
                <Card key={index} className="group hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 text-center border-2 hover:border-colmena-yellow/50">
                  <CardContent className="p-8">
                    <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-colmena-yellow/10 mb-6 group-hover:scale-110 transition-transform">
                      <feature.icon className="h-8 w-8 text-colmena-yellow" />
                    </div>
                    
                    <h3 className="text-xl font-bold text-colmena-indigo mb-3 group-hover:text-colmena-yellow transition-colors">
                      {feature.title}
                    </h3>
                    
                    <p className="text-gray-600 mb-4 leading-relaxed">
                      {feature.description}
                    </p>
                    
                    <Badge className="bg-colmena-indigo text-white font-semibold">
                      {feature.stat}
                    </Badge>
                  </CardContent>
                </Card>
              ))}
            </div>
          </div>
        </section>

        {/* Traditional Tools */}
        <section className="py-20 bg-gradient-to-br from-colmena-gray-light to-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
                Herramientas Tradicionales
              </h2>
              <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                Los mismos instrumentos artesanales que han sido perfeccionados durante décadas
              </p>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {tools.map((tool, index) => (
                <Card key={index} className="group hover:shadow-xl transition-all duration-500 border-2 hover:border-colmena-yellow/50">
                  <CardContent className="p-6">
                    <div className="flex items-start space-x-4">
                      <div className="text-4xl group-hover:scale-110 transition-transform">
                        🔨
                      </div>
                      <div className="flex-1">
                        <h3 className="text-xl font-bold text-colmena-indigo mb-2 group-hover:text-colmena-yellow transition-colors">
                          {tool.name}
                        </h3>
                        <p className="text-gray-600 mb-3">
                          {tool.use}
                        </p>
                        <Badge variant="outline" className="border-colmena-yellow text-colmena-indigo">
                          {tool.years}
                        </Badge>
                      </div>
                    </div>
                  </CardContent>
                </Card>
              ))}
            </div>
          </div>
        </section>

        {/* Process Facts */}
        <section className="py-20 bg-colmena-indigo relative overflow-hidden">
          <div className="absolute inset-0 opacity-5">
            <div style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L93.3 25v50L50 100 6.7 75V25z' fill='%23FFE882'/%3E%3C/svg%3E")`,
              backgroundSize: '100px 100px'
            }}>
            </div>
          </div>
          
          <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
                Datos del Proceso
              </h2>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto"></div>
            </div>

            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
              <div>
                <div className="text-5xl md:text-6xl font-bold text-colmena-yellow mb-2">72</div>
                <p className="text-gray-300">Capas de Cera</p>
              </div>
              <div>
                <div className="text-5xl md:text-6xl font-bold text-colmena-yellow mb-2">68°C</div>
                <p className="text-gray-300">Temperatura Exacta</p>
              </div>
              <div>
                <div className="text-5xl md:text-6xl font-bold text-colmena-yellow mb-2">100%</div>
                <p className="text-gray-300">Cera Natural</p>
              </div>
              <div>
                <div className="text-5xl md:text-6xl font-bold text-colmena-yellow mb-2">78</div>
                <p className="text-gray-300">Años Perfeccionando</p>
              </div>
            </div>
          </div>
        </section>

        {/* Call to Action */}
        <section className="py-20 bg-white">
          <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
              Experimenta la Diferencia
            </h2>
            <p className="text-xl text-gray-600 mb-12 leading-relaxed">
              Cada cirio de La Colmena lleva consigo 78 años de perfeccionamiento artesanal. 
              Descubre por qué nuestro proceso hace la diferencia.
            </p>
            <div className="flex flex-col sm:flex-row gap-6 justify-center">
              <Link to="/catalogo">
                <Button 
                  size="lg" 
                  className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold px-8 py-4 rounded-full shadow-xl group"
                >
                  <Eye className="mr-3 h-5 w-5 group-hover:scale-110 transition-transform" />
                  Ver Nuestros Cirios
                  <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform" />
                </Button>
              </Link>
              <Link to="/historia">
                <Button 
                  variant="outline" 
                  size="lg"
                  className="border-2 border-colmena-indigo text-colmena-indigo hover:bg-colmena-indigo hover:text-white font-semibold px-8 py-4 rounded-full group"
                >
                  📖 Conoce Nuestra Historia
                </Button>
              </Link>
            </div>
          </div>
        </section>
      </div>
    </Layout>
  );
}
