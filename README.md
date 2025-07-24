# La Colmena

A modern React SPA for La Colmena, built with Vite, TypeScript, and TailwindCSS.

## 🚀 Quick Start

```bash
# Install dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

## 📁 Project Structure

```
client/                   # React SPA source code
├── components/           # Reusable React components
│   └── ui/              # UI component library (Radix UI + Tailwind)
├── pages/               # Page components (routes)
├── hooks/               # Custom React hooks
├── lib/                 # Utility functions
├── App.tsx              # Main app component with routing
└── global.css           # Global styles and Tailwind imports

public/                  # Static assets
dist/                    # Build output (generated)
```

## 🎨 Styling

- **TailwindCSS 3** for utility-first styling
- **Radix UI** for accessible, unstyled components
- **Custom brand colors** defined in `tailwind.config.ts`
- **Lucide React** for icons

### Brand Colors

```css
/* Available as Tailwind classes */
.text-colmena-indigo      /* #2D3047 */
.bg-colmena-yellow        /* #FFE882 */
.text-colmena-gray-light  /* #F5F5F5 */
.bg-colmena-gray-dark     /* #333333 */
```

## 🛣️ Routing

React Router 6 with SPA mode. Pages are located in `client/pages/`:

- `/` - Home page (`Index.tsx`)
- `/catalogo` - Product catalog (`Catalogo.tsx`)
- `/historia` - Company history (`Historia.tsx`)
- `/proceso` - Production process (`Proceso.tsx`)

## 🔧 Available Scripts

| Command              | Description                           |
| -------------------- | ------------------------------------- |
| `npm run dev`        | Start development server on port 8080 |
| `npm run build`      | Create production build               |
| `npm run preview`    | Preview production build locally      |
| `npm test`           | Run Vitest tests                      |
| `npm run typecheck`  | Run TypeScript type checking          |
| `npm run format.fix` | Format code with Prettier             |

## 🚀 Deployment

This project is configured for **Vercel** deployment:

### Deploy to Vercel

1. **Connect to GitHub**: Link your repository to Vercel
2. **Import Project**: Vercel will auto-detect the configuration
3. **Deploy**: Automatic deployments on every push to main

### Manual Deployment

```bash
# Install Vercel CLI
npm i -g vercel

# Deploy
vercel --prod
```

### Configuration

- **Build Command**: `npm run build`
- **Output Directory**: `dist`
- **Framework**: Vite
- **Routing**: SPA routing configured in `vercel.json`

## 🛠️ Development

### Adding a New Page

1. Create component in `client/pages/NewPage.tsx`:

```tsx
import Layout from "@/components/Layout";

export default function NewPage() {
  return (
    <Layout>
      <div className="container mx-auto px-4 py-8">
        <h1 className="text-4xl font-bold">New Page</h1>
        <p>Content goes here...</p>
      </div>
    </Layout>
  );
}
```

2. Add route in `client/App.tsx`:

```tsx
import NewPage from "./pages/NewPage";

// Add to Routes:
<Route path="/new-page" element={<NewPage />} />;
```

### Adding New Colors

1. Update `tailwind.config.ts`:

```ts
colors: {
  // ... existing colors
  brand: {
    primary: "#your-color",
    secondary: "#another-color",
  }
}
```

2. Use in components:

```tsx
<div className="bg-brand-primary text-white">Your content</div>
```

## 🧪 Testing

Tests are written with Vitest. Run tests with:

```bash
npm test
```

## 📝 License

Private project for La Colmena.
