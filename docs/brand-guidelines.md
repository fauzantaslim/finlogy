---
name: finlogy-brand-guidelines
description: Defines a clean, modern, and trustworthy brand identity for a financial education platform targeting beginner investors. Optimized for readability, clarity, and scalable design systems.
license: Internal use
---

# Finlogy Brand Styling

## Overview

This brand guideline establishes a clean and trustworthy visual identity for a financial education platform aimed at beginner investors.

The design focuses on:
- Clarity over complexity  
- Trust and credibility  
- Modern minimal UI  
- High readability (especially mobile)

---

## Brand Guidelines

### Colors

**Core Colors:**

- Primary Dark: `#004225` — Primary text and dark backgrounds  
- Primary Light: `#F5F5DC` — Light backgrounds and text on dark
- Soft Neutral: `#FFCF9D` — Secondary elements  
- Accent Light: `#FFCF9D` — Borders and subtle backgrounds  

---

**Accent Colors:**

- Primary Accent: `#004225` — Main actions (buttons, highlights)
- Secondary Accent: `#FFB000` — Call-to-action, highlights, attention
- Support Accent: `#FFCF9D` — Soft highlight / background accents   

---

### Color Philosophy

- **Dark Green (`#004225`)** → Trust, stability, finance  
- **Beige (`#F5F5DC`)** → Calm, readable background  
- **Orange (`#FFB000`)** → Action, attention, CTA  
- **Soft Peach (`#FFCF9D`)** → Friendly, warm UI  

---

### Semantic Tokens

Use semantic tokens in implementation (not raw HEX):

- `color-bg-primary` → Primary Light  
- `color-bg-secondary` → Soft Neutral  
- `color-text-primary` → Primary Dark  
- `color-text-secondary` → Soft Neutral (darker usage)  
- `color-border` → Accent Light  

- `color-accent-primary` → Primary Dark  
- `color-accent-secondary` → Secondary Accent  
- `color-accent-soft` → Soft Neutral  

---

### Color Usage Rules

- Backgrounds → `color-bg-primary` / `color-bg-secondary`  
- Headings → `color-text-primary`  
- Body text → slightly muted version of Primary Dark  
- Buttons → `color-accent-primary`  
- CTA / highlights → `color-accent-secondary`  

👉 Avoid hardcoding HEX in components.

---

## Typography

- **Headings**: Poppins (fallback: Arial, sans-serif)  
- **Body Text**: Poppins (fallback: system-ui, sans-serif)

---

### Typography Scale

- H1: 28–32px → Bold  
- H2: 22–26px → Semi-bold  
- H3: 18–20px → Medium  
- Body: 14–16px → Regular  
- Small text: 12–13px  

---

## Layout Style

- Minimal and content-focused  
- Generous whitespace  
- Grid-based layout  
- Mobile-first  

---

## Component Design

### Buttons

- Background: Primary Dark (`#004225`)  
- Text: White  
- Radius: 6–8px  
- Hover: darker green shade  

---

### Cards

- Background: Primary Light  
- Border: Accent Light (`#FFCF9D`)  
- Shadow: subtle  

---

### Links

- Color: Secondary Accent (`#FFB000`)  
- Hover: underline  

---

## UI Philosophy

- Simplicity over decoration  
- Clarity over complexity  
- Readability first  

---

## Content Tone & Voice

- Educational  
- Friendly  
- Clear  
- Not overly technical  

---

## Technical Guidelines

### Color Implementation

- Use semantic tokens  
- Do not use raw HEX directly in components  
- Define colors in theme/config  

---

### Font Management

- Use Poppins via Google Fonts  
- Provide fallback fonts  
- Optimize loading  

---

### Responsive Design

- Mobile-first  
- Max content width: 640–768px  
- Padding: 16–24px  

---

## Brand Personality

- ✔️ Trustworthy  
- ✔️ Warm  
- ✔️ Friendly  
- ✔️ Modern  

---
