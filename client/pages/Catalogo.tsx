import { useState } from "react";
import { Filter, Grid, List, Search, ChevronDown, Heart, ShoppingBag, Star, X } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Checkbox } from "@/components/ui/checkbox";
import { Slider } from "@/components/ui/slider";
import Layout from "@/components/Layout";

export default function Catalogo() {
  const [viewMode, setViewMode] = useState<'grid' | 'list'>('grid');
  const [sortBy, setSortBy] = useState('featured');
  const [priceRange, setPriceRange] = useState([0, 2000]);
  const [selectedCategories, setSelectedCategories] = useState<string[]>([]);
  const [selectedSizes, setSelectedSizes] = useState<string[]>([]);
  const [selectedOccasions, setSelectedOccasions] = useState<string[]>([]);
  const [searchQuery, setSearchQuery] = useState('');
  const [showMobileFilters, setShowMobileFilters] = useState(false);

  const categories = [
    { id: 'altar', name: 'Cirios para el Altar', count: 45 },
    { id: 'pascua', name: 'Cirios de Pascua', count: 12 },
    { id: 'alabanza', name: 'Cirios de Alabanza', count: 30 },
    { id: 'clavos', name: 'Clavos de Cera', count: 8 },
    { id: 'ceremoniales', name: 'Cirios Ceremoniales', count: 25 },
    { id: 'especiales', name: 'Tamaños Especiales', count: 18 }
  ];

  const sizes = [
    { id: '3cm', name: '3cm (7.62cm diámetro)', count: 24 },
    { id: '4cm', name: '4cm (10.16cm diámetro)', count: 32 },
    { id: '5cm', name: '5cm (15.24cm diámetro)', count: 28 },
    { id: '6cm', name: '6cm (15.24cm diámetro)', count: 20 },
    { id: '8cm', name: '8cm (20.30cm diámetro)', count: 16 }
  ];

  const occasions = [
    { id: 'boda', name: 'Bodas', count: 18 },
    { id: 'bautizo', name: 'Bautizos', count: 14 },
    { id: 'primera-comunion', name: 'Primera Comunión', count: 12 },
    { id: 'confirmacion', name: 'Confirmación', count: 10 },
    { id: 'funeral', name: 'Funerales', count: 8 },
    { id: 'navidad', name: 'Navidad', count: 6 }
  ];

  const products = [
    {
      id: 1,
      name: 'Cirio para Altar No. 4 - 30cm',
      category: 'altar',
      price: 450,
      originalPrice: null,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Ff9ba62a94eb143c09097de1a91339637?format=webp&width=800',
      rating: 4.9,
      reviews: 89,
      badge: 'Tradicional',
      description: 'Cera de abeja 100% natural, método de inmersión',
      diameter: '10.16cm',
      height: '30cm',
      occasion: ['altar', 'boda']
    },
    {
      id: 2,
      name: 'Cirio de Pascua con Cordero',
      category: 'pascua',
      price: 680,
      originalPrice: 750,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Fcc1a422805c04706b531f827a4a7c119?format=webp&width=800',
      rating: 5.0,
      reviews: 42,
      badge: 'Pascual',
      description: 'Con decoración simbólica y resplandor dorado',
      diameter: '10.16cm',
      height: '50cm',
      occasion: ['pascua']
    },
    {
      id: 3,
      name: 'Cirio de Alabanza 5cm x 25cm',
      category: 'alabanza',
      price: 320,
      originalPrice: null,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Fcc1a422805c04706b531f827a4a7c119?format=webp&width=800',
      rating: 4.8,
      reviews: 67,
      badge: 'Popular',
      description: 'Con imágenes religiosas, 30+ opciones',
      diameter: '5cm',
      height: '25cm',
      occasion: ['alabanza', 'bautizo']
    },
    {
      id: 4,
      name: 'Clavos de Cera - Caja 5 piezas',
      category: 'clavos',
      price: 180,
      originalPrice: null,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Fcc1a422805c04706b531f827a4a7c119?format=webp&width=800',
      rating: 4.7,
      reviews: 156,
      badge: 'Devocional',
      description: 'Para ceremonias especiales y devoción',
      diameter: '1cm',
      height: '10cm',
      occasion: ['ceremoniales']
    },
    {
      id: 5,
      name: 'Cirio Nupcial Doble - Set Pareja',
      category: 'ceremoniales',
      price: 1200,
      originalPrice: 1400,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Ff9ba62a94eb143c09097de1a91339637?format=webp&width=800',
      rating: 4.9,
      reviews: 34,
      badge: 'Exclusivo',
      description: 'Grabado personalizado para bodas',
      diameter: '8cm',
      height: '40cm',
      occasion: ['boda']
    },
    {
      id: 6,
      name: 'Cirio de Primera Comunión',
      category: 'ceremoniales',
      price: 380,
      originalPrice: null,
      image: 'https://cdn.builder.io/api/v1/image/assets%2F388293b599ce4051b06e9c48ccb61b9a%2Fcc1a422805c04706b531f827a4a7c119?format=webp&width=800',
      rating: 4.8,
      reviews: 78,
      badge: 'Bendición',
      description: 'Diseño especial para primera comunión',
      diameter: '6cm',
      height: '35cm',
      occasion: ['primera-comunion']
    }
  ];

  const handleCategoryChange = (categoryId: string) => {
    setSelectedCategories(prev => 
      prev.includes(categoryId) 
        ? prev.filter(id => id !== categoryId)
        : [...prev, categoryId]
    );
  };

  const handleSizeChange = (sizeId: string) => {
    setSelectedSizes(prev => 
      prev.includes(sizeId) 
        ? prev.filter(id => id !== sizeId)
        : [...prev, sizeId]
    );
  };

  const handleOccasionChange = (occasionId: string) => {
    setSelectedOccasions(prev => 
      prev.includes(occasionId) 
        ? prev.filter(id => id !== occasionId)
        : [...prev, occasionId]
    );
  };

  const clearAllFilters = () => {
    setSelectedCategories([]);
    setSelectedSizes([]);
    setSelectedOccasions([]);
    setPriceRange([0, 2000]);
    setSearchQuery('');
  };

  const FilterSidebar = () => (
    <div className="space-y-6">
      {/* Search */}
      <div>
        <h3 className="font-semibold text-colmena-indigo mb-4 flex items-center">
          <Search className="mr-2 h-5 w-5" />
          Buscar
        </h3>
        <div className="relative">
          <input
            type="text"
            placeholder="Buscar cirios..."
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            className="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-colmena-yellow focus:border-transparent"
          />
          <Search className="absolute left-3 top-3.5 h-5 w-5 text-gray-400" />
        </div>
      </div>

      {/* Price Range */}
      <div>
        <h3 className="font-semibold text-colmena-indigo mb-4">Rango de Precio</h3>
        <div className="px-2">
          <Slider
            value={priceRange}
            onValueChange={setPriceRange}
            max={2000}
            min={0}
            step={50}
            className="mb-4"
          />
          <div className="flex justify-between text-sm text-gray-600">
            <span>${priceRange[0]}</span>
            <span>${priceRange[1]}</span>
          </div>
        </div>
      </div>

      {/* Categories */}
      <div>
        <h3 className="font-semibold text-colmena-indigo mb-4">Categorías</h3>
        <div className="space-y-3">
          {categories.map((category) => (
            <div key={category.id} className="flex items-center space-x-3">
              <Checkbox
                checked={selectedCategories.includes(category.id)}
                onCheckedChange={() => handleCategoryChange(category.id)}
                className="data-[state=checked]:bg-colmena-yellow data-[state=checked]:border-colmena-yellow"
              />
              <label className="flex-1 text-sm cursor-pointer">
                {category.name}
                <span className="text-gray-500 ml-1">({category.count})</span>
              </label>
            </div>
          ))}
        </div>
      </div>

      {/* Sizes */}
      <div>
        <h3 className="font-semibold text-colmena-indigo mb-4">Tamaños</h3>
        <div className="space-y-3">
          {sizes.map((size) => (
            <div key={size.id} className="flex items-center space-x-3">
              <Checkbox
                checked={selectedSizes.includes(size.id)}
                onCheckedChange={() => handleSizeChange(size.id)}
                className="data-[state=checked]:bg-colmena-yellow data-[state=checked]:border-colmena-yellow"
              />
              <label className="flex-1 text-sm cursor-pointer">
                {size.name}
                <span className="text-gray-500 ml-1">({size.count})</span>
              </label>
            </div>
          ))}
        </div>
      </div>

      {/* Occasions */}
      <div>
        <h3 className="font-semibold text-colmena-indigo mb-4">Ocasiones</h3>
        <div className="space-y-3">
          {occasions.map((occasion) => (
            <div key={occasion.id} className="flex items-center space-x-3">
              <Checkbox
                checked={selectedOccasions.includes(occasion.id)}
                onCheckedChange={() => handleOccasionChange(occasion.id)}
                className="data-[state=checked]:bg-colmena-yellow data-[state=checked]:border-colmena-yellow"
              />
              <label className="flex-1 text-sm cursor-pointer">
                {occasion.name}
                <span className="text-gray-500 ml-1">({occasion.count})</span>
              </label>
            </div>
          ))}
        </div>
      </div>

      {/* Clear Filters */}
      <Button 
        variant="outline" 
        onClick={clearAllFilters}
        className="w-full border-colmena-indigo text-colmena-indigo hover:bg-colmena-indigo hover:text-white"
      >
        Limpiar Filtros
      </Button>
    </div>
  );

  return (
    <Layout>
      <div className="min-h-screen bg-colmena-gray-light">
        {/* Header */}
        <div className="bg-colmena-indigo py-16">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">
              Catálogo de Cirios
            </h1>
            <p className="text-xl text-gray-200 max-w-3xl mx-auto">
              Descubre nuestra colección completa de cirios artesanales hechos con cera de abeja 100% natural
            </p>
            <div className="w-24 h-1 bg-colmena-yellow mx-auto mt-6"></div>
          </div>
        </div>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          {/* Mobile Filter Toggle */}
          <div className="lg:hidden mb-6">
            <Button
              onClick={() => setShowMobileFilters(!showMobileFilters)}
              className="w-full bg-colmena-indigo text-white"
            >
              <Filter className="mr-2 h-4 w-4" />
              {showMobileFilters ? 'Ocultar Filtros' : 'Mostrar Filtros'}
            </Button>
          </div>

          {/* Filters Bar - Mobile */}
          {showMobileFilters && (
            <div className="lg:hidden mb-6 p-6 bg-white rounded-lg shadow-lg border border-colmena-yellow/20">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold text-colmena-indigo">Filtros</h2>
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={() => setShowMobileFilters(false)}
                >
                  <X className="h-4 w-4" />
                </Button>
              </div>
              <FilterSidebar />
            </div>
          )}

          <div className="flex flex-col lg:flex-row gap-8">
            {/* Sidebar Filters - Desktop */}
            <div className="hidden lg:block w-80">
              <div className="sticky top-24 bg-white p-6 rounded-lg shadow-lg border border-colmena-yellow/20">
                <h2 className="text-xl font-bold text-colmena-indigo mb-6 flex items-center">
                  <Filter className="mr-2 h-6 w-6" />
                  Filtros
                </h2>
                <FilterSidebar />
              </div>
            </div>

            {/* Main Content */}
            <div className="flex-1">
              {/* Top Bar */}
              <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div className="flex items-center space-x-4">
                  <span className="text-gray-600">
                    {products.length} productos encontrados
                  </span>
                </div>

                <div className="flex items-center space-x-4">
                  {/* Sort Dropdown */}
                  <div className="relative">
                    <select
                      value={sortBy}
                      onChange={(e) => setSortBy(e.target.value)}
                      className="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-colmena-yellow focus:border-transparent"
                    >
                      <option value="featured">Destacados</option>
                      <option value="price-low">Precio: Menor a Mayor</option>
                      <option value="price-high">Precio: Mayor a Menor</option>
                      <option value="rating">Mejor Valorados</option>
                      <option value="newest">Más Nuevos</option>
                    </select>
                    <ChevronDown className="absolute right-2 top-3 h-4 w-4 text-gray-400 pointer-events-none" />
                  </div>

                  {/* View Mode Toggle */}
                  <div className="flex bg-gray-100 rounded-lg p-1">
                    <Button
                      variant={viewMode === 'grid' ? 'default' : 'ghost'}
                      size="sm"
                      onClick={() => setViewMode('grid')}
                      className={viewMode === 'grid' ? 'bg-colmena-yellow text-colmena-indigo' : ''}
                    >
                      <Grid className="h-4 w-4" />
                    </Button>
                    <Button
                      variant={viewMode === 'list' ? 'default' : 'ghost'}
                      size="sm"
                      onClick={() => setViewMode('list')}
                      className={viewMode === 'list' ? 'bg-colmena-yellow text-colmena-indigo' : ''}
                    >
                      <List className="h-4 w-4" />
                    </Button>
                  </div>
                </div>
              </div>

              {/* Product Grid */}
              <div className={`grid gap-6 ${
                viewMode === 'grid' 
                  ? 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3' 
                  : 'grid-cols-1'
              }`}>
                {products.map((product) => (
                  <Card key={product.id} className="group hover:shadow-xl transition-all duration-300 border-2 hover:border-colmena-yellow/50">
                    <CardContent className="p-0">
                      {viewMode === 'grid' ? (
                        <>
                          <div className="relative">
                            <img 
                              src={product.image} 
                              alt={product.name}
                              className="w-full h-48 object-cover rounded-t-lg"
                            />
                            <Badge className="absolute top-3 left-3 bg-colmena-yellow text-colmena-indigo font-semibold">
                              {product.badge}
                            </Badge>
                            <Button
                              variant="ghost"
                              size="sm"
                              className="absolute top-3 right-3 bg-white/80 hover:bg-white text-gray-600"
                            >
                              <Heart className="h-4 w-4" />
                            </Button>
                          </div>
                          
                          <div className="p-4">
                            <h3 className="font-semibold text-colmena-indigo mb-2 line-clamp-2">
                              {product.name}
                            </h3>
                            
                            <p className="text-sm text-gray-600 mb-2">
                              {product.description}
                            </p>
                            
                            <div className="flex items-center gap-1 mb-3">
                              <div className="flex">
                                {Array.from({ length: 5 }).map((_, i) => (
                                  <Star 
                                    key={i}
                                    className={`h-4 w-4 ${
                                      i < Math.floor(product.rating) 
                                        ? 'text-colmena-yellow fill-current' 
                                        : 'text-gray-300'
                                    }`}
                                  />
                                ))}
                              </div>
                              <span className="text-sm text-gray-600">
                                ({product.reviews})
                              </span>
                            </div>
                            
                            <div className="flex items-center justify-between mb-4">
                              <div>
                                <span className="text-xl font-bold text-colmena-indigo">
                                  ${product.price}
                                </span>
                                {product.originalPrice && (
                                  <span className="text-sm text-gray-500 line-through ml-2">
                                    ${product.originalPrice}
                                  </span>
                                )}
                              </div>
                              <div className="text-xs text-gray-500">
                                {product.diameter} × {product.height}
                              </div>
                            </div>
                            
                            <Button className="w-full bg-colmena-indigo hover:bg-colmena-indigo/90 text-white">
                              <ShoppingBag className="mr-2 h-4 w-4" />
                              Agregar al Carrito
                            </Button>
                          </div>
                        </>
                      ) : (
                        <div className="flex p-4 space-x-4">
                          <div className="relative w-32 h-32 flex-shrink-0">
                            <img 
                              src={product.image} 
                              alt={product.name}
                              className="w-full h-full object-cover rounded-lg"
                            />
                            <Badge className="absolute top-1 left-1 bg-colmena-yellow text-colmena-indigo font-semibold text-xs">
                              {product.badge}
                            </Badge>
                          </div>
                          
                          <div className="flex-1">
                            <div className="flex justify-between items-start mb-2">
                              <h3 className="font-semibold text-colmena-indigo text-lg">
                                {product.name}
                              </h3>
                              <Button variant="ghost" size="sm">
                                <Heart className="h-4 w-4" />
                              </Button>
                            </div>
                            
                            <p className="text-gray-600 mb-3">
                              {product.description}
                            </p>
                            
                            <div className="flex items-center gap-2 mb-3">
                              <div className="flex">
                                {Array.from({ length: 5 }).map((_, i) => (
                                  <Star 
                                    key={i}
                                    className={`h-4 w-4 ${
                                      i < Math.floor(product.rating) 
                                        ? 'text-colmena-yellow fill-current' 
                                        : 'text-gray-300'
                                    }`}
                                  />
                                ))}
                              </div>
                              <span className="text-sm text-gray-600">
                                ({product.reviews} reseñas)
                              </span>
                              <span className="text-sm text-gray-500 ml-auto">
                                {product.diameter} × {product.height}
                              </span>
                            </div>
                            
                            <div className="flex items-center justify-between">
                              <div>
                                <span className="text-2xl font-bold text-colmena-indigo">
                                  ${product.price}
                                </span>
                                {product.originalPrice && (
                                  <span className="text-lg text-gray-500 line-through ml-2">
                                    ${product.originalPrice}
                                  </span>
                                )}
                              </div>
                              <Button className="bg-colmena-indigo hover:bg-colmena-indigo/90 text-white">
                                <ShoppingBag className="mr-2 h-4 w-4" />
                                Agregar al Carrito
                              </Button>
                            </div>
                          </div>
                        </div>
                      )}
                    </CardContent>
                  </Card>
                ))}
              </div>

              {/* Pagination */}
              <div className="mt-12 flex justify-center">
                <div className="flex items-center space-x-2">
                  <Button variant="outline" disabled>
                    Anterior
                  </Button>
                  <Button className="bg-colmena-indigo text-white">1</Button>
                  <Button variant="outline">2</Button>
                  <Button variant="outline">3</Button>
                  <Button variant="outline">
                    Siguiente
                  </Button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  );
}
