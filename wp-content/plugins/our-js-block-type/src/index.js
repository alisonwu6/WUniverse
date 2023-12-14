import "./index.scss"
import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon } from "@wordpress/components";

wp.blocks.registerBlockType("ourplugin/our-js-block-type", {
  title: "Our Js Block Type",
  icon: "smiley",
  category: "common",
  attributes: {
    question: { type: "string" },
    answers: { type: "array", default: ["red", "blue", "green"]},
  },
  edit: EditComponent,
  save: function (props) {
    return null
  }
})

function EditComponent(props) {
  function updateQuestion(value) {
    props.setAttributes({question: value})
  }

  function deleteAnswer(indexToDelete) {
    console.log('props.attributes.answers', props.attributes.answers)
    const newAnswers = props.attributes.answers.filter(function(x, index) {
      return index != indexToDelete;
    })
    props.setAttributes({answers: newAnswers})
  }

  return (
    <div className="our-js-block-type">
      <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize: "20px"}} />
      <p style={{ fontSize: "13px", margin: "20px 0px 8px 0px" }}>Answers:</p>
      {props.attributes.answers.map(function (answer, index) {
        return (
          <Flex>
            <FlexBlock>
              <TextControl value={answer} autoFocus={answer == undefined} onChange={newValue => {
                const newAnswers = props.attributes.answers.concat([]);
                newAnswers[index] = newValue;
                props.setAttributes({answers: newAnswers});
              }} />
            </FlexBlock>
            <FlexItem>
              <Button>
                <Icon className="mark-as-correct" icon="star-empty" />
              </Button>
            </FlexItem>
            <FlexItem>
              <Button isLink className="block-delete" onClick={() => deleteAnswer(index)}>Delete</Button>
            </FlexItem>
          </Flex>
        )
      })}
      <Button isPrimary onClick={() => {
        props.setAttributes({answers: props.attributes.answers.concat([undefined])})
      }}>Add another answer</Button>
    </div>
  )
}