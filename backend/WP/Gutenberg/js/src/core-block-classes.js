/**
 * Add a class to all core blocks.
 *
 * @param props
 * @param blockType
 * @returns {any}
 */

function addBlockClassName( props, blockType ) {
  return Object.assign( props, { class: blockType.name.replace('/', '-') } )
}

wp.hooks.addFilter(
  'blocks.getSaveContent.extraProps',
  'lean-guten-plugin/add-block-class-name',
  addBlockClassName
)