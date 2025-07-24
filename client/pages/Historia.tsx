// React Icons imports
import {
  FiCalendar,
  FiUsers,
  FiAward,
  FiHeart,
  FiMapPin,
  FiStar,
  FiArrowRight
} from "react-icons/fi";
import {
  MdOutlineChurch,
  MdComputer,
  MdOutlineBusinessCenter
} from "react-icons/md";
import {
  GiCandleFlame,
  GiScrollUnfurled,
  GiPaintBrush,
  GiBee
} from "react-icons/gi";
import {
  AiFillHeart
} from "react-icons/ai";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import Layout from "@/components/Layout";
import { Link } from "react-router-dom";

export default function Historia() {
  const timelineEvents = [
    {
      year: "1945",
      title: "Los Orígenes",
      description: "Nace La Colmena en Ciudad de México como una empresa familiar dedicada al arte tradicional de trabajar la cera de abeja 100% natural.",
      icon: GiScrollUnfurled,
      details: "Don Fernando Mendoza y Doña Carmen establecen el primer taller en el corazón de la capital mexicana, preservando técnicas ancestrales de elaboración de cirios.",
      era: "Primera Generación"
    },
    {
      year: "1960",
      title: "Expansión del Arte",
      description: "Se perfecciona el método de inmersión y se incorporan los primeros símbolos religiosos pintados a mano en cada cirio.",
      icon: GiPaintBrush,
      details: "La segunda generación, liderada por Miguel Mendoza, introduce las decoraciones simbólicas que se convertirían en la marca distintiva de La Colmena.",
      era: "Segunda Generación"
    },
    {
      year: "1980",
      title: "Reconocimiento Nacional",
      description: "La Colmena se convierte en proveedor oficial de múltiples parroquias y catedrales en todo México.",
      icon: MdOutlineChurch,
      details: "Los cirios de La Colmena iluminan ceremonias importantes en la Catedral Metropolitana y otras iglesias históricas del país.",
      era: "Consolidación"
    },
    {
      year: "2000",
      title: "Nueva Era Digital",
      description: "La tercera generación abraza la modernidad manteniendo la tradición, llevando los cirios artesanales al nuevo milenio.",
      icon: MdComputer,
      details: "Carlos Mendoza implementa procesos de calidad modernos sin perder la esencia artesanal que caracteriza cada pieza.",
      era: "Tercera Generación"
    },
    {
      year: "2024",
      title: "78 Años de Tradición",
      description: "Hoy celebramos casi ocho décadas iluminando momentos sagrados, manteniendo viva la llama de la tradición familiar.",
      icon: GiCandleFlame,
      details: "Con presencia digital y técnicas tradicionales, La Colmena continúa siendo sinónimo de calidad y devoción en México.",
      era: "Presente"
    }
  ];

  const familyValues = [
    {
      icon: FiHeart,
      title: "Fe y Devoción",
      description: "Cada cirio es creado con respeto hacia las tradiciones religiosas y el significado sagrado que representan.",
      color: "text-red-500"
    },
    {
      icon: FiUsers,
      title: "Legado Familiar",
      description: "Tres generaciones han preservado y transmitido el conocimiento artesanal de padre a hijo.",
      color: "text-blue-500"
    },
    {
      icon: FiAward,
      title: "Calidad Artesanal",
      description: "Nunca hemos comprometido la calidad por la cantidad. Cada pieza es única y especial.",
      color: "text-colmena-yellow"
    },
    {
      icon: FiStar,
      title: "Innovación Respetuosa",
      description: "Incorporamos mejoras modernas sin perder la esencia tradicional que nos caracteriza.",
      color: "text-green-500"
    }
  ];

  const achievements = [
    { number: "78+", label: "Años de Historia", icon: FiCalendar },
    { number: "3", label: "Generaciones", icon: FiUsers },
    { number: "100%", label: "Cera Natural", icon: GiBee },
    { number: "500+", label: "Iglesias Servidas", icon: MdOutlineChurch },
    { number: "72", label: "Capas por Cirio", icon: GiCandleFlame },
    { number: "∞", label: "Momentos Iluminados", icon: FiStar }
  ];

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
              Nuestra Historia
            </h1>
            <p className="text-xl md:text-2xl text-gray-200 mb-8 max-w-4xl mx-auto leading-relaxed">
              Desde 1945, tres generaciones han preservado el arte ancestral de crear cirios con cera de abeja 100% natural, 
              iluminando los momentos más sagrados de las familias mexicanas.
            </p>
            <div className="w-32 h-1 bg-colmena-yellow mx-auto"></div>
          </div>
        </section>



        {/* Timeline Section */}
        <section className="py-20 bg-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
                Línea del Tiempo
              </h2>
              <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                Un viaje a través de las décadas que han forjado la tradición de La Colmena
              </p>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
            </div>

            <div className="relative">
              {/* Timeline Line */}
              <div className="absolute left-1/2 transform -translate-x-0.5 w-1 h-full bg-colmena-yellow/30 hidden lg:block"></div>

              <div className="space-y-12 lg:space-y-16">
                {timelineEvents.map((event, index) => (
                  <div key={index} className={`flex flex-col lg:flex-row items-center ${
                    index % 2 === 0 ? 'lg:flex-row' : 'lg:flex-row-reverse'
                  }`}>
                    {/* Content Card */}
                    <div className={`w-full lg:w-5/12 ${
                      index % 2 === 0 ? 'lg:pr-12' : 'lg:pl-12'
                    }`}>
                      <Card className="group hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border-2 hover:border-colmena-yellow/50">
                        <CardContent className="p-8">
                          <div className="flex items-center mb-4">
                            <Badge className="bg-colmena-yellow text-colmena-indigo font-bold text-lg px-4 py-2">
                              {event.year}
                            </Badge>
                            <span className="ml-4 text-sm text-gray-500 font-medium">
                              {event.era}
                            </span>
                          </div>
                          
                          <h3 className="text-2xl font-bold text-colmena-indigo mb-4 group-hover:text-colmena-yellow transition-colors">
                            {event.title}
                          </h3>
                          
                          <p className="text-gray-700 mb-4 leading-relaxed">
                            {event.description}
                          </p>
                          
                          <p className="text-sm text-gray-600 italic">
                            {event.details}
                          </p>
                        </CardContent>
                      </Card>
                    </div>

                    {/* Timeline Icon */}
                    <div className="w-16 h-16 bg-colmena-yellow rounded-full flex items-center justify-center shadow-lg border-4 border-white my-6 lg:my-0 relative z-10">
                      <event.icon className="text-2xl text-colmena-indigo" />
                    </div>

                    {/* Spacer for desktop */}
                    <div className="hidden lg:block w-5/12"></div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        {/* Family Values */}
        <section className="py-20 bg-gradient-to-br from-colmena-gray-light to-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-16">
              <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
                Nuestros Valores
              </h2>
              <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                Los principios que han guiado a la familia Mendoza durante casi ocho décadas
              </p>
              <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              {familyValues.map((value, index) => (
                <Card key={index} className="group hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 text-center border-2 hover:border-colmena-yellow/50">
                  <CardContent className="p-8">
                    <div className={`inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-6 group-hover:scale-110 transition-transform`}>
                      <value.icon className={`h-8 w-8 ${value.color}`} />
                    </div>
                    
                    <h3 className="text-xl font-bold text-colmena-indigo mb-4 group-hover:text-colmena-yellow transition-colors">
                      {value.title}
                    </h3>
                    
                    <p className="text-gray-600 leading-relaxed">
                      {value.description}
                    </p>
                  </CardContent>
                </Card>
              ))}
            </div>
          </div>
        </section>

        {/* Heritage Quote */}
        <section className="py-20 bg-colmena-indigo relative overflow-hidden">
          <div className="absolute inset-0 opacity-5">
            <div style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L93.3 25v50L50 100 6.7 75V25z' fill='%23FFE882'/%3E%3C/svg%3E")`,
              backgroundSize: '100px 100px'
            }}>
            </div>
          </div>
          
          <div className="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <AiFillHeart className="text-6xl mb-8 mx-auto text-colmena-yellow" />
            <blockquote className="text-2xl md:text-3xl text-white font-light italic mb-8 leading-relaxed">
              "No solo creamos cirios, preservamos momentos. Cada llama que encendemos 
              lleva consigo 78 años de tradición, fe y amor familiar."
            </blockquote>
            <cite className="text-colmena-yellow font-semibold text-lg">
              - Carlos Mendoza, Tercera Generación
            </cite>
          </div>
        </section>

        {/* Location & Contact */}
        <section className="py-20 bg-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
              <div>
                <h2 className="text-4xl font-bold text-colmena-indigo mb-6">
                  Visítanos en Ciudad de México
                </h2>
                <p className="text-lg text-gray-600 mb-8 leading-relaxed">
                  Nuestro taller sigue en el mismo lugar donde comenzó todo en 1945. 
                  Te invitamos a conocer de cerca el proceso artesanal y descubrir 
                  por qué cada cirio de La Colmena es único.
                </p>
                
                <div className="space-y-4 mb-8">
                  <div className="flex items-start space-x-3">
                    <FiMapPin className="h-6 w-6 text-colmena-yellow mt-1" />
                    <div>
                      <h4 className="font-semibold text-colmena-indigo">Dirección</h4>
                      <p className="text-gray-600">Centro Histórico, Ciudad de México</p>
                    </div>
                  </div>
                  <div className="flex items-start space-x-3">
                    <FiCalendar className="h-6 w-6 text-colmena-yellow mt-1" />
                    <div>
                      <h4 className="font-semibold text-colmena-indigo">Horarios</h4>
                      <p className="text-gray-600">Lunes a Sábado: 9:00 AM - 6:00 PM</p>
                    </div>
                  </div>
                </div>
                
                <div className="flex flex-col sm:flex-row gap-4">
                  <Link to="/proceso">
                    <Button className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold">
                      <FiArrowRight className="mr-2 h-4 w-4" />
                      Ver Nuestro Proceso
                    </Button>
                  </Link>
                  <Link to="/contacto">
                    <Button variant="outline" className="border-colmena-indigo text-colmena-indigo hover:bg-colmena-indigo hover:text-white">
                      Agendar Visita
                    </Button>
                  </Link>
                </div>
              </div>
              
              <div className="relative">
                <div className="bg-colmena-gray-light p-8 rounded-2xl shadow-xl">
                  <div className="text-center">
                    <MdOutlineBusinessCenter className="text-8xl mb-6 mx-auto text-colmena-indigo" />
                    <h3 className="text-2xl font-bold text-colmena-indigo mb-4">
                      Taller Tradicional
                    </h3>
                    <p className="text-gray-600 leading-relaxed">
                      El mismo lugar donde todo comenzó, preservando la magia 
                      del proceso artesanal en el corazón de México.
                    </p>
                  </div>
                </div>
                
                {/* Floating elements */}
                <div className="absolute -top-4 -right-4 w-16 h-16 bg-colmena-yellow/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-colmena-yellow/30 animate-bounce">
                  <GiCandleFlame className="text-2xl text-colmena-yellow" />
                </div>
                <div className="absolute -bottom-4 -left-4 w-12 h-12 bg-colmena-yellow/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-colmena-yellow/30 animate-pulse">
                  <FiStar className="text-xl text-colmena-yellow" />
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </Layout>
  );
}
