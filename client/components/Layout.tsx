import { Link, useLocation } from "react-router-dom";
import { Button } from "./ui/button";
import { ReactNode, useState, useEffect } from "react";
// React Icons imports
import {
  FiShoppingBag,
  FiSearch,
  FiHeart,
  FiMenu,
  FiX,
  FiHome,
  FiBook,
  FiTool,
  FiPhone,
  FiArrowRight,
} from "react-icons/fi";
import { GiHoneypot, GiCandleFlame, GiBee } from "react-icons/gi";
import { MdOutlineChurch, MdOutlineHistoryEdu } from "react-icons/md";

interface LayoutProps {
  children: ReactNode;
}

export default function Layout({ children }: LayoutProps) {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);
  const [isSearchOpen, setIsSearchOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState("");
  const location = useLocation();

  // Only homepage has transparent header initially
  const isHomepage = location.pathname === "/";

  useEffect(() => {
    if (isHomepage) {
      const handleScroll = () => {
        // Check if scrolled past hero section (roughly viewport height)
        const scrollPosition = window.scrollY;
        const heroSectionHeight = window.innerHeight;
        setIsScrolled(scrollPosition > heroSectionHeight * 0.8);
      };

      window.addEventListener("scroll", handleScroll);
      handleScroll(); // Check initial position

      return () => window.removeEventListener("scroll", handleScroll);
    } else {
      // For non-homepage routes, header should always have background
      setIsScrolled(true);
    }
  }, [isHomepage]);

  // Keyboard shortcuts for search
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      // Open search with Cmd+K or Ctrl+K
      if ((e.metaKey || e.ctrlKey) && e.key === "k") {
        e.preventDefault();
        setIsSearchOpen(true);
      }
      // Close search with Escape
      if (e.key === "Escape" && isSearchOpen) {
        setIsSearchOpen(false);
        setSearchQuery("");
      }
      // Search on Enter
      if (e.key === "Enter" && isSearchOpen && searchQuery) {
        // Handle search action here
        console.log("Searching for:", searchQuery);
      }
    };

    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [isSearchOpen, searchQuery]);

  const toggleMobileMenu = () => {
    setIsMobileMenuOpen(!isMobileMenuOpen);
  };

  return (
    <div className="min-h-screen bg-white">
      {/* Glassmorphism Navigation Header */}
      <header
        className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
          isScrolled
            ? "backdrop-blur-md bg-colmena-indigo/80 border-b border-white/10 shadow-lg"
            : "backdrop-blur-none bg-transparent border-b border-transparent"
        }`}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-20">
            {/* Logo */}
            <Link to="/" className="flex items-center space-x-3 z-10">
              <div className="w-10 h-10 bg-gradient-to-br from-colmena-yellow to-yellow-400 rounded-xl flex items-center justify-center shadow-lg">
                <GiBee className="text-colmena-indigo text-xl" />
              </div>
              <div className="flex flex-col">
                <span className="text-colmena-yellow font-bold text-xl tracking-tight">
                  La Colmena
                </span>
                <span className="text-white/70 text-xs font-light">
                  Desde 1945
                </span>
              </div>
            </Link>

            {/* Desktop Navigation - Centered */}
            <nav className="hidden lg:flex items-center space-x-1 absolute left-1/2 transform -translate-x-1/2">
              <Link
                to="/"
                className="px-4 py-2 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 font-medium"
              >
                Inicio
              </Link>
              <Link
                to="/catalogo"
                className="px-4 py-2 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 font-medium"
              >
                Catálogo
              </Link>
              <Link
                to="/historia"
                className="px-4 py-2 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 font-medium"
              >
                Historia
              </Link>
              <Link
                to="/proceso"
                className="px-4 py-2 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 font-medium"
              >
                Proceso
              </Link>
            </nav>

            {/* Right side actions */}
            <div className="flex items-center space-x-3">
              {/* Search Icon - Hidden on small screens */}
              <Button
                variant="ghost"
                size="sm"
                className="hidden md:flex text-white/80 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300"
                onClick={() => setIsSearchOpen(true)}
              >
                <FiSearch className="h-5 w-5" />
              </Button>

              <Button
                variant="ghost"
                size="sm"
                className="hidden md:flex text-white/80 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300"
              >
                <FiHeart className="h-5 w-5" />
              </Button>

              <Button
                variant="ghost"
                size="sm"
                className="hidden md:flex text-white/80 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 relative"
              >
                <FiShoppingBag className="h-5 w-5" />
                <span className="absolute -top-1 -right-1 bg-colmena-yellow text-colmena-indigo text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                  0
                </span>
              </Button>

              {/* Mobile/Tablet menu button */}
              <Button
                variant="ghost"
                size="sm"
                className="lg:hidden text-white/80 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 p-2"
                onClick={toggleMobileMenu}
              >
                <FiMenu className="h-6 w-6" />
              </Button>
            </div>
          </div>
        </div>
      </header>

      {/* Mobile/Tablet Slide-out Menu */}
      <div
        className={`fixed inset-0 z-50 lg:hidden ${isMobileMenuOpen ? "pointer-events-auto" : "pointer-events-none"}`}
      >
        {/* Backdrop */}
        <div
          className={`absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 ${
            isMobileMenuOpen ? "opacity-100" : "opacity-0"
          }`}
          onClick={toggleMobileMenu}
        />

        {/* Side Panel */}
        <div
          className={`absolute right-0 top-0 h-full w-80 max-w-[85vw] bg-gradient-to-br from-colmena-indigo via-colmena-indigo/95 to-colmena-indigo/90 backdrop-blur-xl border-l border-white/10 transform transition-transform duration-300 ease-out ${
            isMobileMenuOpen ? "translate-x-0" : "translate-x-full"
          }`}
        >
          {/* Panel Header */}
          <div className="flex items-center justify-between p-6 border-b border-white/10">
            <div className="flex items-center space-x-3">
              <div className="w-8 h-8 bg-gradient-to-br from-colmena-yellow to-yellow-400 rounded-lg flex items-center justify-center">
                <GiBee className="text-colmena-indigo text-lg" />
              </div>
              <div>
                <span className="text-colmena-yellow font-bold text-lg">
                  La Colmena
                </span>
                <p className="text-white/60 text-xs">Tradición desde 1945</p>
              </div>
            </div>
            <Button
              variant="ghost"
              size="sm"
              className="text-white/80 hover:text-colmena-yellow hover:bg-white/10 rounded-lg transition-all duration-300 p-2"
              onClick={toggleMobileMenu}
            >
              <FiX className="h-5 w-5" />
            </Button>
          </div>

          {/* Search Bar */}
          <div className="p-6 border-b border-white/10">
            <div className="relative">
              <input
                type="text"
                placeholder="Buscar cirios, tamaños..."
                className="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-colmena-yellow focus:border-transparent backdrop-blur-sm"
              />
              <FiSearch className="absolute left-3 top-3.5 h-5 w-5 text-white/60" />
            </div>
          </div>

          {/* Navigation Links */}
          <nav className="flex-1 p-6 space-y-2">
            <Link
              to="/"
              className="flex items-center space-x-3 px-4 py-3 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-xl transition-all duration-300 group"
              onClick={toggleMobileMenu}
            >
              <FiHome className="h-5 w-5 group-hover:scale-110 transition-transform" />
              <span className="font-medium">Inicio</span>
            </Link>
            <Link
              to="/catalogo"
              className="flex items-center space-x-3 px-4 py-3 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-xl transition-all duration-300 group"
              onClick={toggleMobileMenu}
            >
              <FiBook className="h-5 w-5 group-hover:scale-110 transition-transform" />
              <span className="font-medium">Catálogo</span>
            </Link>
            <Link
              to="/historia"
              className="flex items-center space-x-3 px-4 py-3 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-xl transition-all duration-300 group"
              onClick={toggleMobileMenu}
            >
              <MdOutlineHistoryEdu className="h-5 w-5 group-hover:scale-110 transition-transform" />
              <span className="font-medium">Nuestra Historia</span>
            </Link>
            <Link
              to="/proceso"
              className="flex items-center space-x-3 px-4 py-3 text-white/90 hover:text-colmena-yellow hover:bg-white/10 rounded-xl transition-all duration-300 group"
              onClick={toggleMobileMenu}
            >
              <FiTool className="h-5 w-5 group-hover:scale-110 transition-transform" />
              <span className="font-medium">Proceso Artesanal</span>
            </Link>
          </nav>

          {/* Panel Footer Actions */}
          <div className="p-6 border-t border-white/10 space-y-3">
            <Button className="w-full bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold py-3 rounded-xl transition-all duration-300">
              <FiHeart className="mr-2 h-4 w-4" />
              Favoritos
            </Button>
            <Button
              variant="outline"
              className="w-full border-white/30 text-white hover:bg-white/10 font-semibold py-3 rounded-xl transition-all duration-300"
            >
              <FiShoppingBag className="mr-2 h-4 w-4" />
              Carrito (0)
            </Button>
          </div>
        </div>
      </div>

      {/* Cool Search Modal */}
      <div
        className={`fixed inset-0 z-50 ${isSearchOpen ? "pointer-events-auto" : "pointer-events-none"}`}
      >
        {/* Animated Backdrop */}
        <div
          className={`absolute inset-0 bg-black/80 backdrop-blur-xl transition-all duration-500 ${
            isSearchOpen ? "opacity-100" : "opacity-0"
          }`}
          onClick={() => {
            setIsSearchOpen(false);
            setSearchQuery("");
          }}
        />

        {/* Search Container */}
        <div
          className={`absolute inset-0 flex items-center justify-center p-4 transition-all duration-700 ease-out ${
            isSearchOpen
              ? "translate-y-0 opacity-100"
              : "-translate-y-20 opacity-0"
          }`}
        >
          <div
            className={`w-full max-w-4xl transition-all duration-500 delay-200 ${
              isSearchOpen ? "scale-100" : "scale-95"
            }`}
          >
            {/* Search Header */}
            <div className="text-center mb-8">
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-4">
                Buscar en{" "}
                <span className="text-colmena-yellow">La Colmena</span>
              </h2>
              <p className="text-gray-300 text-lg">
                Encuentra cirios, categorías, procesos y más
              </p>
            </div>

            {/* Main Search Input */}
            <div className="relative mb-8">
              <div className="absolute inset-0 bg-gradient-to-r from-colmena-yellow/20 to-colmena-indigo/20 rounded-2xl blur-xl"></div>
              <div className="relative bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-2xl">
                <div className="flex items-center p-6">
                  <FiSearch className="h-8 w-8 text-colmena-yellow mr-6 flex-shrink-0" />
                  <input
                    type="text"
                    value={searchQuery}
                    onChange={(e) => setSearchQuery(e.target.value)}
                    placeholder="¿Qué cirio estás buscando?"
                    className="flex-1 bg-transparent text-white placeholder-white/60 text-xl focus:outline-none"
                    autoFocus
                  />
                  <Button
                    variant="ghost"
                    size="sm"
                    className="text-white/60 hover:text-white ml-4"
                    onClick={() => {
                      setIsSearchOpen(false);
                      setSearchQuery("");
                    }}
                  >
                    <FiX className="h-6 w-6" />
                  </Button>
                </div>
              </div>
            </div>

            {/* Quick Search Categories */}
            <div
              className={`transition-all duration-700 delay-400 ${
                isSearchOpen
                  ? "translate-y-0 opacity-100"
                  : "translate-y-10 opacity-0"
              }`}
            >
              <p className="text-white/80 text-center mb-6">
                Búsquedas populares:
              </p>
              <div className="flex flex-wrap justify-center gap-3">
                {[
                  "Cirios de Pascua",
                  "Velas Aromáticas",
                  "Cirios para Altar",
                  "Clavos de Cera",
                  "Cirios Nupciales",
                  "Proceso Artesanal",
                ].map((category, index) => (
                  <button
                    key={index}
                    className="px-6 py-3 bg-white/10 hover:bg-colmena-yellow/20 border border-white/20 hover:border-colmena-yellow/40 rounded-full text-white hover:text-colmena-yellow transition-all duration-300 backdrop-blur-sm transform hover:scale-105"
                    onClick={() => {
                      setSearchQuery(category);
                    }}
                  >
                    {category}
                  </button>
                ))}
              </div>
            </div>

            {/* Search Results Preview */}
            {searchQuery && (
              <div
                className={`mt-8 transition-all duration-500 ${
                  searchQuery
                    ? "translate-y-0 opacity-100"
                    : "translate-y-10 opacity-0"
                }`}
              >
                <div className="bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-6">
                  <h3 className="text-white font-semibold mb-4 flex items-center">
                    <FiSearch className="h-5 w-5 mr-2 text-colmena-yellow" />
                    Resultados para "{searchQuery}"
                  </h3>
                  <div className="space-y-3">
                    <div className="flex items-center p-3 rounded-lg hover:bg-white/10 transition-colors cursor-pointer">
                      <GiCandleFlame className="h-6 w-6 text-colmena-yellow mr-3" />
                      <div>
                        <p className="text-white font-medium">
                          Cirio para Altar No. 4
                        </p>
                        <p className="text-white/60 text-sm">
                          Cera de abeja 100% natural
                        </p>
                      </div>
                    </div>
                    <div className="flex items-center p-3 rounded-lg hover:bg-white/10 transition-colors cursor-pointer">
                      <GiCandleFlame className="h-6 w-6 text-colmena-yellow mr-3" />
                      <div>
                        <p className="text-white font-medium">
                          Cirio de Pascua con Cordero
                        </p>
                        <p className="text-white/60 text-sm">
                          Con decoración simbólica
                        </p>
                      </div>
                    </div>
                    <div className="flex items-center p-3 rounded-lg hover:bg-white/10 transition-colors cursor-pointer">
                      <MdOutlineChurch className="h-6 w-6 text-colmena-yellow mr-3" />
                      <div>
                        <p className="text-white font-medium">
                          Categoría: Cirios Ceremoniales
                        </p>
                        <p className="text-white/60 text-sm">
                          25 productos disponibles
                        </p>
                      </div>
                    </div>
                  </div>
                  <div className="mt-4 pt-4 border-t border-white/20">
                    <Button className="w-full bg-colmena-yellow text-colmena-indigo hover:bg-colmena-yellow/90 font-semibold">
                      Ver todos los resultados
                      <FiArrowRight className="ml-2 h-4 w-4" />
                    </Button>
                  </div>
                </div>
              </div>
            )}

            {/* Keyboard Shortcuts */}
            <div
              className={`mt-8 text-center transition-all duration-700 delay-600 ${
                isSearchOpen
                  ? "translate-y-0 opacity-100"
                  : "translate-y-10 opacity-0"
              }`}
            >
              <div className="flex items-center justify-center space-x-4 text-white/40 text-sm">
                <div className="flex items-center space-x-2">
                  <kbd className="px-2 py-1 bg-white/10 rounded text-xs">
                    ESC
                  </kbd>
                  <span>para cerrar</span>
                </div>
                <div className="flex items-center space-x-2">
                  <kbd className="px-2 py-1 bg-white/10 rounded text-xs">
                    ENTER
                  </kbd>
                  <span>para buscar</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Content - Conditional padding based on route */}
      <main className={isHomepage ? "" : "pt-20"}>{children}</main>

      {/* Enhanced Footer */}
      <footer className="bg-colmena-indigo relative overflow-hidden">
        {/* Golden wax drips effect */}
        <div
          className="absolute top-0 left-0 right-0 h-8 bg-gradient-to-r from-transparent via-colmena-yellow/20 to-transparent"
          style={{
            background: `url("data:image/svg+xml,%3Csvg width='100' height='20' viewBox='0 0 100 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0c10 5 20 10 30 8s20-8 30-6 20 6 30 4s20-6 40 0v8H0V0z' fill='%23FFE882' fill-opacity='0.3'/%3E%3C/svg%3E") repeat-x`,
          }}
        />

        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
              <div className="flex items-center space-x-3 mb-6">
                <div className="w-10 h-10 bg-gradient-to-br from-colmena-yellow to-yellow-400 rounded-xl flex items-center justify-center shadow-lg">
                  <GiBee className="text-colmena-indigo text-xl" />
                </div>
                <div>
                  <span className="text-colmena-yellow font-bold text-xl">
                    La Colmena
                  </span>
                  <p className="text-white/60 text-xs">Desde 1945</p>
                </div>
              </div>
              <p className="text-gray-300 text-sm leading-relaxed">
                Hecho en México con cera, fe y 78 años de historia. Tradición
                artesanal que ilumina momentos sagrados.
              </p>
            </div>

            <div>
              <h3 className="font-semibold mb-6 text-colmena-yellow flex items-center">
                <GiCandleFlame className="text-lg mr-2" />
                Guía
              </h3>
              <ul className="space-y-3 text-sm text-gray-300">
                <li>
                  <Link
                    to="/guia-tamanos"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Guía de Tamaños
                  </Link>
                </li>
                <li>
                  <Link
                    to="/cuidado"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Cuidado de Cirios
                  </Link>
                </li>
                <li>
                  <Link
                    to="/envios"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Envíos
                  </Link>
                </li>
              </ul>
            </div>

            <div>
              <h3 className="font-semibold mb-6 text-colmena-yellow flex items-center">
                <MdOutlineChurch className="text-lg mr-2" />
                Fe
              </h3>
              <ul className="space-y-3 text-sm text-gray-300">
                <li>
                  <Link
                    to="/blog"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Cómo Elegir tu Cirio
                  </Link>
                </li>
                <li>
                  <Link
                    to="/ceremonias"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Ceremonias Sagradas
                  </Link>
                </li>
                <li>
                  <Link
                    to="/simbolos"
                    className="hover:text-colmena-yellow transition-colors flex items-center"
                  >
                    <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                    Simbolos Cristianos
                  </Link>
                </li>
              </ul>
            </div>

            <div>
              <h3 className="font-semibold mb-6 text-colmena-yellow flex items-center">
                <FiPhone className="text-lg mr-2" />
                Contacto
              </h3>
              <ul className="space-y-3 text-sm text-gray-300">
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                  +52 (55) 1234-5678
                </li>
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                  info@lacolmena.mx
                </li>
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-colmena-yellow/60 rounded-full mr-2"></span>
                  Ciudad de México
                </li>
              </ul>
            </div>
          </div>

          <div className="border-t border-gray-600 mt-12 pt-8 text-center">
            <p className="text-gray-300 text-sm">
              &copy; 2024 La Colmena. Todos los derechos reservados.
              <span className="text-colmena-yellow"> Siempre Contigo</span>{" "}
              <GiCandleFlame className="inline h-4 w-4" />
            </p>
          </div>
        </div>
      </footer>
    </div>
  );
}
