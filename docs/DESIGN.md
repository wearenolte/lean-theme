# Design System
Our philosphy is that the admin experience be as simple to use as possible, and not require a designer to edit content. With this in mind, Lean attempts to make design decisions around spacing for the user based on the layout they build. This document explains the rules which are built into the theme:


## Spacing

See the [Design System](https://projects.invisionapp.com/dsm/nolte/portland/folder/components/5e1bbd958eb1718656355b70) for an explanation of the responsive spacing options. The theme ships with these options plus a series of additional options based on the 8px steps: 0, .5 (.5rem), 1 (1rem), 1.5 (1.5rem), etc. All sizes user `rem` units with the default base font size of 16px.


### Vertical Spacing

#### Section Blocks (`.section-block`)
Section blocks are groups and columns by default, but you will probably want to make some of your custom blocks into sections too. To do this just add the `.section-block` class to the wrapper. The rules are:
- Top-level sections blocks have XXL padding top and bottom by defalt
- Top padding reduced to 0 if the section block has no background and follows another section block which also has no background.
- Lower level section blocks (ie blocks within blocks) have XXL top padding only.
- Top padding for lower level section blocks reduced to 0 if it is the first child.
- The column block top padding is reduced to MD if it follows another column with the same number of columns (in this case we are assuming the admin is building a grid rather than 2 separate sections, and the spacing needs to be reduced accordingly).
- Column top padding is LG if the columns follow an H2 or H3

#### Media Blocks (`.media-block`)
Add the `media-block` class to any block which is considered media (eg image, video, slider, audio).
- Default to a top margin of M.
- Overriden to XL if the block follows a paragraph.

#### Typography Blocks
Includes headers, paragraphs and lists. Use the `standard-text-spacing` class to apply the same spacing elsewhere (eg to WYSIWYG fields).
- Paragraphs and lists have top margin of MD when following an H1, H2 or H3.
- Paragraphs and lists have top margin of XS when following an H4, H5 or H6.
- Paragraphs and lists have top margin of SM when following another paragraph or list.
- All headings have top margin XL by default.
- An H3 following an H2 has XS top margin.
- An H3 following an H5 or H6 has 8px top margin.
- An H4, H5 or H6 following an H3 has XS top margin.

#### Quote Blocks
- Default top margin of MD
- Overriden to XL if it follows a paragraph.

#### Separator Block
- No top/bottom spacing.

#### Table Block
- Default top margin of XL.

#### Buttons
- Default top margin of MD.
- Overriden to SM if sfollowing another button.


<!-- ### Headings (`.heading-block`)
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
- 0 bottom sapcing if it is the last child element of the parent. -->

### Horizontal Spacing
We use [TailWind flex class](https://tailwindcss.com/components/grids/#app) to build the grid. The columns block will swap the % widths set for TailWind width classes, it picks the most appropriate option depending on the % you set. For example 8% would result in `w-full md:w-1/12` and 25% would result in `w-full md:w-3/12` (all based on a 12 column desktop grid). The gutter between columns is set in `DesignSystem.php`.

You should use the same logic if you need to build complex custom blocks which use the grid.

#### Columns
If a column block meets the following critera:
- Has 2 columns
- One of the columns contains media (eg video, image, slider) but the other does not. Note the list of media blocks is maintained in the `BlockSettings::MEDIA_BLOCKS` array.
- The width of both columns is set to 50% (it cannot be left blank)
Then we override the column without media to 5/12 and create a 1 column space between it and the media column (which remains at 6/12).


## Other Stuff

### Editor Colors
The colors available in the editor (used to set block backgrounds) are set in PHP. For now you will have to duplicate these into `DesignSystem.php`. From here they will be automatically enabled in the editor and backgrounds will work in the front-end.

### Animations
The site uses native CSS and Javascript animations only (except for the slider library).

#### Scroll Animations
The default fade-in (opacity from 0 to 1) animation is applied to:
- All columns (ie the individual columns within the columns container).
- All top-level elements except cols and groups.
- All elements which are top-level in a top-level group, except other columnss and groups.

On desktop, the following exceptions are applied:
- Individual columns which are part of a 2 column set: transform X and opacity.
- Individual columns which are part of a 3 column set: add an additional delay of .3s to each column so they fade in one by one.
