# Design System
Our philosphy is that the admin experience be as simple to use as possible, and not require a designer to edit content. With this in mind, Lean attempts to make design decisions around spacing for the user based on the layout they build. This document explains the rules which are built into the theme:


## Vertical Spacing

### Sections (`.section-block`)
Section blocks (Groups and Columns) behave as follows:
- Lean will add a large padding (10rem) to the top and bottom of each section to separate it from the next and previous ones (`spacing.section-y`).
- If the section is within another section then reduce the spacing to 2.5rem (`spacing.subsection-y`).

### Headings (`.heading-block`)
The Heading block has the following spacing rules:
- Larger spacing by default (6.667rem bottom margin) (`spacing.heading-b`).
- Reduced by half (to 3.333rem) if used within a column (`spacing.heading-in-col-b`).
- 0 bottom sapcing if it is the last child element of the parent.

### Text (`.text-block`)
The Paragraph and List block use the `text-block` rules:
- Small default spacing below of 2rem (`spacing.text-block-b`) if followed by another text-block.
- Add spacing above of 1.333rem (`spacing.following-text-block-b`) to blocks wqhich follow a text block. This results in a total spacing of 3.333rem (2rem from the text-block above plus 1.333rem).
- 0 bottom sapcing if it is the last child element of the parent.

### Default (`.default-block`)
All other blocks (eg Image, Video and Button) use the `default-block` rules:
- Spacing below of 3.333rem (`spacing.default-block-b`) if followed by another block.
- 0 bottom sapcing if it is the last child element of the parent.

## Horizontal Spacing
We use [TailWind flex class](https://tailwindcss.com/components/grids/#app) to build the grid. The columns block will swap the % widths set for TailWind width classes, it picks the most appropriate option depending on the % you set. For example 8% would result in `w-full md:w-1/12` and 25% would result in `w-full md:w-3/12` (all based on a 12 column desktop grid). The gutter between columns is set in the TailWind config as `spacing.gutter`.

You should use the same logic if you need to build complex custom blocks which use the grid.


## Padding & Colors

### Lists
- Each sub-list is indented by 2.5rem (`spacing.list-indent`).

### Bordered Blocks
- Preformatted and code blocks have a border with padding of 2rem (`spacing.pre-padding`). The border color is set by `colors.pre-border`.
- Table cells are padded by 0.5rem (`spacing.table-padding`). The border color is set by `colors.table-border`.

### Button
- The primary button has left/right padding of 1rem (`spacing.primary-btn-padding-x`) and top/bottom of 0.5rem (`spacing.primary-btn-padding-y`). Its font and background colours are `colors.primary-btn` and `colors.primat-btn-bg` respectively.

### Separator
- The separator color is `colors.separator`.

### Editor Colors
The colors available in the editor (used to set block backgrounds) are set in PHP. For now you will have to duplicate these into DesignSystem.php. From here they will be automatically enabled in the editor and backgrounds will work in the front-end.
