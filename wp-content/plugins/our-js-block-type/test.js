wp.blocks.registerBlockType("ourplugin/our-js-block-type", {
  title: "Our Js Block Type",
  icon: "smiley",
  category: "common",
  edit: function () {
    return wp.element.createElement("h3", null, "Hello, this is from the admin editor screen.")
  },
  save: function () {
    return wp.element.createElement("h1", null, "This is the frontend.")
  }
})
