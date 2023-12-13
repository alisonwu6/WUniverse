wp.blocks.registerBlockType("ourplugin/our-js-block-type", {
  title: "Our Js Block Type",
  icon: "smiley",
  category: "common",
  edit: function () {
    return (
      <div>
        <p>Hello, this is a paragraph.</p>
        <h4>Hi there.</h4>
      </div>
    )
  },
  save: function () {
    return (
      <div>
        <h3>This is the frontend.</h3>
      </div>
    )
  }
})
