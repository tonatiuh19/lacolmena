import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import Layout from "@/components/Layout";
import { Link } from "react-router-dom";
import { useState, useEffect, useRef } from "react";
// React Icons imports
import {
  FiStar,
  FiArrowRight,
  FiHeart,
  FiPlay,
  FiCheckCircle,
  FiPhone,
  FiTruck,
  FiShield,
  FiHeadphones,
  FiGift,
  FiEye,
} from "react-icons/fi";
import { GiCandleFlame, GiHoneypot, GiBee } from "react-icons/gi";
import { RiSparklingFill } from "react-icons/ri";
import {
  MdOutlineChurch,
  MdFamilyRestroom,
  MdCelebration,
  MdTimer,
} from "react-icons/md";
import { RiPaletteLine } from "react-icons/ri";

export default function Index() {
  const [activeStep, setActiveStep] = useState(0);
  const [videoLoaded, setVideoLoaded] = useState(false);
  const [videoError, setVideoError] = useState(false);
  const videoRef = useRef<HTMLVideoElement>(null);

  // Handle video loading
  useEffect(() => {
    const video = videoRef.current;
    if (video) {
      const handleLoadedData = () => {
        setVideoLoaded(true);
        video.play().catch(() => {
          setVideoError(true);
        });
      };

      const handleError = () => {
        setVideoError(true);
      };

      video.addEventListener("loadeddata", handleLoadedData);
      video.addEventListener("error", handleError);

      return () => {
        video.removeEventListener("loadeddata", handleLoadedData);
        video.removeEventListener("error", handleError);
      };
    }
  }, []);

  const processSteps = [
    {
      title: "La Cera Pura",
      description:
        "Solo usamos cera de abeja 100% natural – libre de químicos, como la fe debe ser.",
      icon: GiHoneypot,
      detail: "Extraída directamente de panales mexicanos",
    },
    {
      title: "Inmersión Lenta",
      description:
        "72 capas de cera, 72 horas de paciencia. Así nacen los cirios que nunca humean.",
      icon: GiCandleFlame,
      detail: "Técnica milenaria transmitida por generaciones",
    },
    {
      title: "El Toque Sagrado",
      description: "Cada símbolo se pinta a mano, como una oración.",
      icon: RiSparklingFill,
      detail: "Cordero, cruz y detalles dorados únicos",
    },
  ];

  const collections = [
    {
      name: "Boda",
      title: "Cirios Nupciales",
      description: "Para un amor que dura tanto como la cera que lo alimenta.",
      icon: MdCelebration,
      price: "Desde $680",
      features: [
        "Grabado personalizado",
        "Caja de regalo",
        "Certificado de autenticidad",
      ],
    },
    {
      name: "Familia",
      title: "Altar Familiar",
      description: "La luz que guía a tus ancestros.",
      icon: MdFamilyRestroom,
      price: "Desde $450",
      features: [
        "Tamaños variados",
        "Símbolos familiares",
        "Bendición incluida",
      ],
    },
    {
      name: "Momentos Sagrados",
      title: "Ceremonias Especiales",
      description: "Fe que se enciende, esperanza que no se apaga.",
      icon: MdOutlineChurch,
      price: "Desde $320",
      features: [
        "Diversos santos",
        "Ocasiones especiales",
        "Empaque ceremonial",
      ],
    },
  ];

  const testimonials = [
    {
      name: "María y José González",
      location: "Ciudad de México",
      quote:
        "Sus cirios iluminaron nuestro 50° aniversario. Como el primer día.",
      icon: MdFamilyRestroom,
      rating: 5,
      occasion: "Aniversario de Bodas",
    },
    {
      name: "Familia Rodríguez",
      location: "Guadalajara",
      quote:
        "El toque perfecto para nuestra boda católica. Cada detalle fue sublime.",
      icon: MdCelebration,
      rating: 5,
      occasion: "Boda Religiosa",
    },
    {
      name: "Padre Miguel Santos",
      location: "Puebla",
      quote:
        "Llevamos años usando sus cirios en la parroquia. Calidad excepcional.",
      icon: MdOutlineChurch,
      rating: 5,
      occasion: "Ceremonias Parroquiales",
    },
  ];

  return (
    <Layout>
      {/* Hero Section: Enhanced "La Luz del Amor" */}
      <section className="relative h-screen flex items-center justify-center overflow-hidden">
        {/* Background video or fallback */}
        <div className="absolute inset-0">
          {!videoError && (
            <video
              ref={videoRef}
              className={`absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ${
                videoLoaded ? "opacity-100" : "opacity-0"
              }`}
              autoPlay
              muted
              loop
              playsInline
              onError={() => setVideoError(true)}
            >
              <source
                src="https://garbrix.com/lacolmena/assets/videos/hero-section2.mp4"
                type="video/mp4"
              />
            </video>
          )}

          {/* Enhanced overlays for better text readability */}
          <div
            className={`absolute inset-0 bg-gradient-to-br from-black/60 via-colmena-indigo/80 to-black/70 transition-opacity duration-1000 ${
              videoLoaded && !videoError ? "opacity-90" : "opacity-100"
            }`}
          >
            {/* Strong dark overlay for text readability */}
            <div className="absolute inset-0 bg-black/40"></div>
            {/* Cinematic vignette */}
            <div className="absolute inset-0 bg-gradient-radial from-transparent via-black/30 to-black/70"></div>
            {/* Text area specific darkening */}
            <div className="absolute inset-0 bg-gradient-to-r from-black/60 via-transparent to-transparent lg:from-black/70 lg:via-black/30 lg:to-transparent"></div>
            {/* Dynamic golden particles */}
            <div
              className="absolute inset-0"
              style={{
                background: `radial-gradient(circle at 20% 80%, rgba(255, 232, 130, 0.3) 0%, transparent 40%),
                               radial-gradient(circle at 80% 20%, rgba(255, 232, 130, 0.2) 0%, transparent 40%),
                               radial-gradient(circle at 40% 40%, rgba(255, 232, 130, 0.1) 0%, transparent 30%)`,
              }}
            ></div>
          </div>
        </div>

        {/* Main Content Grid */}
        <div className="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center min-h-screen">
          {/* Left Content - Main Message */}
          <div className="lg:col-span-7 text-left lg:text-left order-2 lg:order-1 relative">
            <div className="relative z-10 lg:pl-4">
              {/* Animated Badge */}
              <div
                className="inline-flex items-center mb-6 animate-fadeInUp"
                style={{ animationDelay: "0.2s" }}
              >
                <Badge className="bg-colmena-yellow/20 text-colmena-yellow border-colmena-yellow/30 backdrop-blur-sm px-6 py-2 text-sm font-semibold">
                  <GiBee className="mr-2 h-4 w-4" />
                  Tradición Artesanal desde 1945
                </Badge>
              </div>

              {/* Main Headline */}
              <h1
                className="text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-8 leading-tight animate-fadeInUp"
                style={{
                  textShadow:
                    "3px 3px 12px rgba(0,0,0,0.95), 0 0 40px rgba(0,0,0,0.8), 1px 1px 6px rgba(0,0,0,1)",
                  animationDelay: "0.4s",
                }}
              >
                La Luz del{" "}
                <span className="relative inline-block">
                  <span className="text-colmena-yellow animate-glow">Amor</span>
                  <div className="absolute -inset-1 bg-colmena-yellow/20 blur-xl rounded-lg animate-pulse"></div>
                </span>
              </h1>

              {/* Subtitle with enhanced styling */}
              <p
                className="text-xl md:text-2xl lg:text-3xl text-gray-100 mb-8 max-w-2xl leading-relaxed animate-fadeInUp font-light"
                style={{
                  textShadow:
                    "2px 2px 8px rgba(0,0,0,0.95), 0 0 30px rgba(0,0,0,0.8), 1px 1px 4px rgba(0,0,0,1)",
                  animationDelay: "0.6s",
                }}
              >
                Cirios de{" "}
                <span className="text-colmena-yellow font-semibold">
                  cera de abeja 100% natural
                </span>{" "}
                que han iluminado momentos sagrados durante tres generaciones.
              </p>

              {/* Enhanced CTA Buttons */}
              <div
                className="flex flex-col sm:flex-row gap-4 mb-8 animate-fadeInUp"
                style={{ animationDelay: "0.8s" }}
              >
                <Button
                  size="lg"
                  className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-bold px-8 py-4 text-lg rounded-full shadow-2xl hover:shadow-colmena-yellow/40 transition-all duration-500 transform hover:scale-105 group"
                  onClick={() => {
                    const nextSection = document.querySelector(
                      "section:nth-of-type(2)",
                    );
                    nextSection?.scrollIntoView({ behavior: "smooth" });
                  }}
                >
                  Ver más
                </Button>

                <Link to="/catalogo">
                  <Button
                    size="lg"
                    className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-bold px-8 py-4 text-lg rounded-full shadow-2xl hover:shadow-colmena-yellow/40 transition-all duration-500 transform hover:scale-105 group"
                  >
                    Ver Catálogo
                  </Button>
                </Link>
              </div>

              {/* Stats Preview */}
              <div
                className="flex flex-wrap gap-6 text-white/80 animate-fadeInUp"
                style={{ animationDelay: "1s" }}
              >
                <div className="flex items-center space-x-2">
                  <div className="w-2 h-2 bg-colmena-yellow rounded-full animate-pulse"></div>
                  <span className="text-sm font-medium">
                    78+ años de experiencia
                  </span>
                </div>
                <div className="flex items-center space-x-2">
                  <div
                    className="w-2 h-2 bg-colmena-yellow rounded-full animate-pulse"
                    style={{ animationDelay: "0.5s" }}
                  ></div>
                  <span className="text-sm font-medium">100% cera natural</span>
                </div>
                <div className="flex items-center space-x-2">
                  <div
                    className="w-2 h-2 bg-colmena-yellow rounded-full animate-pulse"
                    style={{ animationDelay: "1s" }}
                  ></div>
                  <span className="text-sm font-medium">
                    72 capas por cirio
                  </span>
                </div>
              </div>
            </div>{" "}
            {/* Close relative z-10 div */}
          </div>

          {/* Right Content - Interactive Elements */}
          <div className="lg:col-span-5 relative order-1 lg:order-2">
            {/* Floating Candle Showcase */}
            <div
              className="relative h-96 lg:h-[500px] animate-fadeInRight"
              style={{ animationDelay: "1.2s" }}
            >
              {/* Central Candle Animation */}
              <div className="absolute inset-0 flex items-center justify-center">
                <div className="relative transform hover:scale-110 transition-transform duration-700">
                  <div className="w-32 h-32 lg:w-40 lg:h-40 bg-gradient-to-br from-colmena-yellow via-yellow-400 to-amber-500 rounded-full flex items-center justify-center shadow-2xl animate-float">
                    <GiCandleFlame className="text-6xl lg:text-7xl text-colmena-indigo" />
                  </div>
                  <div className="absolute -inset-4 bg-colmena-yellow/20 rounded-full blur-xl animate-pulse"></div>
                </div>
              </div>

              {/* Orbiting Elements */}
              <div className="absolute inset-0 animate-spin-slow">
                {/* Honeypot */}
                <div className="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-4">
                  <div className="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-lg hover:scale-110 transition-transform">
                    <GiHoneypot className="text-2xl text-colmena-yellow" />
                  </div>
                </div>

                {/* Sparkles */}
                <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-4">
                  <div className="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-lg hover:scale-110 transition-transform">
                    <RiSparklingFill className="text-2xl text-colmena-yellow" />
                  </div>
                </div>

                {/* Bee */}
                <div className="absolute top-1/2 left-0 transform -translate-y-1/2 -translate-x-4">
                  <div className="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-lg hover:scale-110 transition-transform">
                    <GiBee className="text-2xl text-colmena-yellow" />
                  </div>
                </div>

                {/* Church */}
                <div className="absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-4">
                  <div className="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-lg hover:scale-110 transition-transform">
                    <MdOutlineChurch className="text-2xl text-colmena-yellow" />
                  </div>
                </div>
              </div>

              {/* Connecting Lines */}
              <div className="absolute inset-0 opacity-30">
                <svg className="w-full h-full" viewBox="0 0 400 400">
                  <circle
                    cx="200"
                    cy="200"
                    r="150"
                    fill="none"
                    stroke="rgb(255, 232, 130)"
                    strokeWidth="1"
                    strokeDasharray="5,5"
                    className="animate-dash"
                  />
                </svg>
              </div>
            </div>
          </div>
        </div>

        {/* Enhanced Scroll Indicator */}
        <div
          className="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-center animate-fadeInUp"
          style={{ animationDelay: "2s" }}
        >
          <div className="w-1 h-16 bg-gradient-to-b from-transparent via-colmena-yellow to-transparent rounded-full animate-bounce mx-auto"></div>
        </div>

        {/* Particle Effects */}
        <div className="absolute inset-0 pointer-events-none">
          {[...Array(20)].map((_, i) => (
            <div
              key={i}
              className="absolute w-1 h-1 bg-colmena-yellow/30 rounded-full animate-float"
              style={{
                left: `${Math.random() * 100}%`,
                top: `${Math.random() * 100}%`,
                animationDelay: `${Math.random() * 5}s`,
                animationDuration: `${3 + Math.random() * 4}s`,
              }}
            />
          ))}
        </div>
      </section>

      {/* Features Bar */}
      <section className="bg-colmena-yellow py-6">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
            <div className="flex items-center justify-center space-x-2">
              <FiTruck className="h-6 w-6 text-colmena-indigo" />
              <span className="text-colmena-indigo font-semibold">
                Envío Gratis +$500
              </span>
            </div>
            <div className="flex items-center justify-center space-x-2">
              <FiShield className="h-6 w-6 text-colmena-indigo" />
              <span className="text-colmena-indigo font-semibold">
                Compra Protegida
              </span>
            </div>
            <div className="flex items-center justify-center space-x-2">
              <FiHeadphones className="h-6 w-6 text-colmena-indigo" />
              <span className="text-colmena-indigo font-semibold">
                Soporte 24/7
              </span>
            </div>
            <div className="flex items-center justify-center space-x-2">
              <FiStar className="h-6 w-6 text-colmena-indigo" />
              <span className="text-colmena-indigo font-semibold">
                Puntos Miel
              </span>
            </div>
          </div>
        </div>
      </section>

      {/* "Nuestra Esencia" - Storytelling Split Screen */}
      <section className="py-20 bg-gradient-to-br from-colmena-gray-light to-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
              Nuestra Esencia
            </h2>
            <div className="w-24 h-1 bg-colmena-yellow mx-auto"></div>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {/* Left Side - Vintage */}
            <div className="relative">
              <div className="bg-gradient-to-br from-amber-100 to-amber-50 p-8 rounded-2xl shadow-xl relative overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-br from-sepia-600/20 to-sepia-800/30 rounded-2xl"></div>
                <div className="relative z-10">
                  <div className="text-center mb-6">
                    <MdOutlineChurch className="text-8xl opacity-60 mx-auto text-amber-800" />
                  </div>
                  <h3 className="text-2xl font-bold text-colmena-indigo mb-4 text-center">
                    1945
                  </h3>
                  <p className="text-gray-700 text-center leading-relaxed">
                    Nace La Colmena en Ciudad de México, cuando nuestros abuelos
                    decidieron preservar el arte ancestral de trabajar la cera
                    de abeja.
                  </p>
                </div>
              </div>
              <Badge className="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-colmena-yellow text-colmena-indigo font-bold px-4 py-2">
                Orígenes
              </Badge>
            </div>

            {/* Right Side - Modern */}
            <div className="relative">
              <div className="bg-gradient-to-br from-white to-colmena-gray-light p-8 rounded-2xl shadow-xl relative overflow-hidden border border-colmena-yellow/20">
                <div className="relative z-10">
                  <div className="text-center mb-6">
                    <GiBee className="text-8xl mx-auto text-colmena-yellow" />
                  </div>
                  <h3 className="text-2xl font-bold text-colmena-indigo mb-4 text-center">
                    2024
                  </h3>
                  <p className="text-gray-700 text-center leading-relaxed">
                    Tres generaciones después, seguimos transformando cera de
                    abeja en luz, manteniendo viva la tradición con la misma
                    pasión.
                  </p>
                </div>
              </div>
              <Badge className="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-colmena-indigo text-white font-bold px-4 py-2">
                Presente
              </Badge>
            </div>
          </div>

          <div className="text-center mt-16 max-w-4xl mx-auto">
            <blockquote className="text-xl md:text-2xl text-gray-700 italic leading-relaxed">
              "Tres generaciones transformando cera de abeja en luz. Cada cirio
              lleva el calor de manos mexicanas y el peso de una promesa:{" "}
              <span className="text-colmena-indigo font-bold">
                pureza, durabilidad y fe
              </span>
              ."
            </blockquote>
          </div>
        </div>
      </section>

      {/* Three Videos Section */}
      <section className="py-20 bg-gradient-to-br from-colmena-gray-light to-white relative overflow-hidden">
        <div className="absolute inset-0 opacity-5">
          <div
            className="absolute inset-0"
            style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFE882' fill-opacity='0.1'%3E%3Ccircle cx='40' cy='40' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
              backgroundSize: "80px 80px",
            }}
          ></div>
        </div>

        <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
              El Arte en Movimiento
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Descubre el proceso artesanal detrás de cada cirio a través de
              estos videos exclusivos
            </p>
            <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
          </div>

          {/* Three Video Grid */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {/* Video 1 - Process */}
            <div className="group relative">
              <div className="relative overflow-hidden rounded-2xl shadow-2xl transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-colmena-yellow/30">
                <div className="aspect-[9/16] bg-gradient-to-br from-colmena-indigo to-colmena-indigo/80 relative">
                  {/* Video placeholder with play button */}
                  <div className="absolute inset-0 bg-black/20"></div>
                  <img
                    src="https://garbrix.com/lacolmena/assets/videos/hero-section2.mp4"
                    alt="Proceso de inmersión"
                    className="w-full h-full object-cover"
                  />

                  {/* Play Button Overlay */}
                  <div className="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/40 transition-all duration-300">
                    <div className="w-20 h-20 bg-colmena-yellow rounded-full flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 shadow-2xl">
                      <FiPlay className="h-8 w-8 text-colmena-indigo ml-1" />
                    </div>
                  </div>

                  {/* Video Info Overlay */}
                  <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                    <h3 className="text-white font-bold text-xl mb-2">
                      El Proceso de Inmersión
                    </h3>
                    <p className="text-gray-200 text-sm">
                      Descubre cómo creamos cada capa de cera
                    </p>
                    <div className="flex items-center mt-3 text-colmena-yellow text-sm">
                      <MdTimer className="h-4 w-4 mr-1" />
                      <span>3:45 min</span>
                    </div>
                  </div>

                  {/* Floating Badge */}
                  <Badge className="absolute top-4 left-4 bg-colmena-yellow text-colmena-indigo font-bold">
                    Proceso
                  </Badge>
                </div>
              </div>
            </div>

            {/* Video 2 - Artisan */}
            <div className="group relative">
              <div className="relative overflow-hidden rounded-2xl shadow-2xl transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-colmena-yellow/30">
                <div className="aspect-[9/16] bg-gradient-to-br from-amber-400 to-amber-600 relative">
                  <div className="absolute inset-0 bg-black/20"></div>
                  <img
                    src="https://garbrix.com/lacolmena/assets/videos/hero-section2.mp4"
                    alt="Artesano trabajando"
                    className="w-full h-full object-cover"
                  />

                  {/* Play Button Overlay */}
                  <div className="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/40 transition-all duration-300">
                    <div className="w-20 h-20 bg-colmena-yellow rounded-full flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 shadow-2xl">
                      <FiPlay className="h-8 w-8 text-colmena-indigo ml-1" />
                    </div>
                  </div>

                  {/* Video Info Overlay */}
                  <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                    <h3 className="text-white font-bold text-xl mb-2">
                      Manos Artesanas
                    </h3>
                    <p className="text-gray-200 text-sm">
                      Conoce a nuestros maestros artesanos
                    </p>
                    <div className="flex items-center mt-3 text-colmena-yellow text-sm">
                      <MdTimer className="h-4 w-4 mr-1" />
                      <span>2:30 min</span>
                    </div>
                  </div>

                  <Badge className="absolute top-4 left-4 bg-amber-500 text-white font-bold">
                    Artesanos
                  </Badge>
                </div>
              </div>
            </div>

            {/* Video 3 - Heritage */}
            <div className="group relative">
              <div className="relative overflow-hidden rounded-2xl shadow-2xl transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-colmena-yellow/30">
                <div className="aspect-[9/16] bg-gradient-to-br from-red-400 to-red-600 relative">
                  <div className="absolute inset-0 bg-black/20"></div>
                  <img
                    src="https://garbrix.com/lacolmena/assets/videos/hero-section2.mp4"
                    alt="Historia familiar"
                    className="w-full h-full object-cover"
                  />

                  {/* Play Button Overlay */}
                  <div className="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/40 transition-all duration-300">
                    <div className="w-20 h-20 bg-colmena-yellow rounded-full flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 shadow-2xl">
                      <FiPlay className="h-8 w-8 text-colmena-indigo ml-1" />
                    </div>
                  </div>

                  {/* Video Info Overlay */}
                  <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                    <h3 className="text-white font-bold text-xl mb-2">
                      Legado Familiar
                    </h3>
                    <p className="text-gray-200 text-sm">
                      78 años de tradición mexicana
                    </p>
                    <div className="flex items-center mt-3 text-colmena-yellow text-sm">
                      <MdTimer className="h-4 w-4 mr-1" />
                      <span>4:15 min</span>
                    </div>
                  </div>

                  <Badge className="absolute top-4 left-4 bg-red-500 text-white font-bold">
                    Historia
                  </Badge>
                </div>
              </div>
            </div>
          </div>

          {/* Video Stats */}
          <div className="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div className="group">
              <div className="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 hover:border-colmena-yellow/50">
                <div className="text-3xl mb-3 group-hover:scale-110 transition-transform">
                  <FiPlay className="mx-auto text-colmena-indigo" />
                </div>
                <div className="text-2xl font-bold text-colmena-indigo mb-2">
                  10M+
                </div>
                <p className="text-gray-600 font-medium">Visualizaciones</p>
              </div>
            </div>
            <div className="group">
              <div className="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 hover:border-colmena-yellow/50">
                <div className="text-3xl mb-3 group-hover:scale-110 transition-transform">
                  <FiHeart className="mx-auto text-red-500" />
                </div>
                <div className="text-2xl font-bold text-colmena-indigo mb-2">
                  98%
                </div>
                <p className="text-gray-600 font-medium">Satisfacción</p>
              </div>
            </div>
            <div className="group">
              <div className="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 hover:border-colmena-yellow/50">
                <div className="text-3xl mb-3 group-hover:scale-110 transition-transform">
                  <RiSparklingFill className="mx-auto text-colmena-yellow" />
                </div>
                <div className="text-2xl font-bold text-colmena-indigo mb-2">
                  78
                </div>
                <p className="text-gray-600 font-medium">Años de Experiencia</p>
              </div>
            </div>
          </div>

          {/* Call to Action */}
          <div className="text-center mt-12">
            <Button
              size="lg"
              className="bg-colmena-indigo hover:bg-colmena-indigo/90 text-white font-semibold px-8 py-4 rounded-full shadow-xl group"
            >
              <FiEye className="mr-3 h-5 w-5 group-hover:scale-110 transition-transform" />
              Ver Todos los Videos
              <FiArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform" />
            </Button>
          </div>
        </div>
      </section>

      {/* "Colección Fe y Amor" - Product Grid with Storytelling */}
      <section className="py-20 bg-gradient-to-br from-white to-colmena-gray-light">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
              Colección Fe y Amor
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Cada colección cuenta una historia, cada cirio guarda una promesa
            </p>
            <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {collections.map((collection, index) => (
              <Card
                key={index}
                className="group overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 hover:border-colmena-yellow/50"
              >
                <CardContent className="p-0">
                  <div className="relative h-64 bg-gradient-to-br from-colmena-indigo to-colmena-indigo/80 flex items-center justify-center overflow-hidden">
                    <collection.icon className="text-8xl group-hover:scale-110 transition-transform duration-500 text-white" />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <Badge className="absolute top-4 left-4 bg-colmena-yellow text-colmena-indigo font-bold">
                      {collection.name}
                    </Badge>

                    {/* Flame animation hover effect */}
                    <div className="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                      <div className="w-6 h-6 bg-colmena-yellow rounded-full animate-pulse"></div>
                    </div>
                  </div>

                  <div className="p-6">
                    <h3 className="text-xl font-bold text-colmena-indigo mb-3">
                      {collection.title}
                    </h3>
                    <p className="text-gray-600 mb-4 leading-relaxed italic">
                      "{collection.description}"
                    </p>

                    <div className="space-y-2 mb-6">
                      {collection.features.map((feature, idx) => (
                        <div
                          key={idx}
                          className="flex items-center text-sm text-gray-600"
                        >
                          <FiCheckCircle className="h-4 w-4 text-colmena-yellow mr-2" />
                          {feature}
                        </div>
                      ))}
                    </div>

                    <div className="flex items-center justify-between">
                      <span className="text-2xl font-bold text-colmena-indigo">
                        {collection.price}
                      </span>
                      <Link to="/catalogo">
                        <Button className="bg-colmena-indigo hover:bg-colmena-indigo/90 text-white group">
                          Ver Colección
                          <FiArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" />
                        </Button>
                      </Link>
                    </div>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* "La Comunidad" - Testimonials */}
      <section className="py-20 bg-gradient-to-br from-colmena-gray-light to-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
              La Comunidad
            </h2>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Testimonios de fe que nos inspiran cada día
            </p>
            <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {testimonials.map((testimonial, index) => (
              <Card
                key={index}
                className="group hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 bg-white border-2 hover:border-colmena-yellow/50"
              >
                <CardContent className="p-8 text-center">
                  <testimonial.icon className="text-6xl mb-6 group-hover:scale-110 transition-transform duration-300 mx-auto text-colmena-indigo" />

                  {/* Wax-seal-shaped rating stars */}
                  <div className="flex justify-center mb-6">
                    <div className="flex space-x-1 bg-colmena-yellow/10 px-4 py-2 rounded-full">
                      {Array.from({ length: testimonial.rating }).map(
                        (_, i) => (
                          <FiStar
                            key={i}
                            className="h-5 w-5 text-colmena-yellow fill-current"
                          />
                        ),
                      )}
                    </div>
                  </div>

                  <blockquote className="text-gray-700 italic mb-6 leading-relaxed">
                    "{testimonial.quote}"
                  </blockquote>

                  <div className="border-t border-colmena-yellow/20 pt-6">
                    <h4 className="font-bold text-colmena-indigo mb-1">
                      {testimonial.name}
                    </h4>
                    <p className="text-sm text-gray-500 mb-2">
                      {testimonial.location}
                    </p>
                    <Badge
                      variant="outline"
                      className="border-colmena-yellow text-colmena-indigo font-medium"
                    >
                      {testimonial.occasion}
                    </Badge>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* "Hazlo Personal" - Customization CTA */}
      <section className="py-20 bg-colmena-indigo relative overflow-hidden">
        <div className="absolute inset-0 opacity-5">
          <div
            style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L93.3 25v50L50 100 6.7 75V25z' fill='%23FFE882'/%3E%3C/svg%3E")`,
              backgroundSize: "100px 100px",
            }}
          ></div>
        </div>

        <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
                Hazlo Personal
              </h2>
              <p className="text-xl text-gray-200 mb-8 leading-relaxed">
                Crea tu cirio del amor – añade iniciales, fechas o símbolos
                sagrados. Cada detalle cuenta tu historia única.
              </p>

              <div className="space-y-4 mb-8">
                <div className="flex items-center space-x-3 text-white">
                  <RiSparklingFill className="h-6 w-6 text-colmena-yellow" />
                  <span>Grabado artesanal de nombres y fechas</span>
                </div>
                <div className="flex items-center space-x-3 text-white">
                  <FiGift className="h-6 w-6 text-colmena-yellow" />
                  <span>Empaque especial de regalo</span>
                </div>
                <div className="flex items-center space-x-3 text-white">
                  <FiHeart className="h-6 w-6 text-colmena-yellow" />
                  <span>Bendición personalizada incluida</span>
                </div>
              </div>

              <Button
                size="lg"
                className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold px-8 py-4 rounded-full shadow-xl hover:shadow-colmena-yellow/25 transition-all duration-500 group"
              >
                <RiSparklingFill className="mr-3 h-5 w-5 group-hover:scale-110 transition-transform" />
                Enciende tu Historia
              </Button>
            </div>

            <div className="relative">
              {/* 3D Candle Mockup Placeholder */}
              <div className="bg-white/10 backdrop-blur-sm rounded-3xl p-8 text-center border border-white/20">
                <GiCandleFlame className="text-8xl mb-6 animate-pulse text-colmena-yellow mx-auto" />
                <h3 className="text-2xl font-bold text-white mb-4">
                  Vista Previa Interactiva
                </h3>
                <p className="text-gray-300 mb-6">
                  Personaliza colores, texto y símbolos en tiempo real
                </p>

                <div className="grid grid-cols-2 gap-4">
                  <div className="bg-colmena-yellow/20 p-4 rounded-xl">
                    <span className="text-colmena-yellow font-bold">
                      Bandas
                    </span>
                    <p className="text-white/80 text-sm">Rojo y Dorado</p>
                  </div>
                  <div className="bg-colmena-yellow/20 p-4 rounded-xl">
                    <span className="text-colmena-yellow font-bold">Texto</span>
                    <p className="text-white/80 text-sm">
                      "Para siempre, 2024"
                    </p>
                  </div>
                </div>
              </div>

              {/* Floating elements */}
              <div className="absolute -top-4 -right-4 w-16 h-16 bg-colmena-yellow/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-colmena-yellow/30 animate-bounce">
                <RiSparklingFill className="text-2xl text-colmena-yellow" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Final CTA */}
      <section className="py-20 bg-gradient-to-br from-white to-colmena-gray-light">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-4xl md:text-5xl font-bold text-colmena-indigo mb-6">
            Ilumina tu Fe
          </h2>
          <p className="text-xl text-gray-600 mb-12 leading-relaxed">
            Descubre en nuestro catálogo el cirio ideal, donde tradición,
            calidad y devoción se unen en un producto hecho en México con
            técnicas ancestrales.
          </p>
          <div className="flex flex-col sm:flex-row gap-6 justify-center">
            <Link to="/catalogo">
              <Button
                size="lg"
                className="bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold px-8 py-4 rounded-full shadow-xl group"
              >
                <GiCandleFlame className="mr-3 h-5 w-5" />
                Ver Catálogo Completo
                <FiArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform" />
              </Button>
            </Link>
            <Button
              variant="outline"
              size="lg"
              className="border-2 border-colmena-indigo text-colmena-indigo hover:bg-colmena-indigo hover:text-white font-semibold px-8 py-4 rounded-full group"
            >
              <FiPhone className="mr-3 h-5 w-5 group-hover:scale-110 transition-transform" />
              Contactar Artesano
            </Button>
          </div>
        </div>
      </section>
    </Layout>
  );
}
