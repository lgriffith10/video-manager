import { defineComponent } from 'vue'
import type { Meta, StoryFn } from '@storybook/vue3'
import Button from './Button.vue'

const meta: Meta<typeof Button> = {
  title: 'UI/Button',
  component: Button,
  tags: ['autodocs'],
  argTypes: {
    variant: {
      control: 'select',
      options: ['default', 'secondary', 'outline', 'destructive', 'ghost', 'link'],
    },
    size: {
      control: 'select',
      options: ['default', 'sm', 'lg', 'icon'],
    },
  },
}

export default meta

type Story = StoryFn<typeof Button>

export const Default: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Default</Button>',
  })
Default.args = { variant: 'default' }

export const Secondary: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Secondary</Button>',
  })
Secondary.args = { variant: 'secondary' }

export const Outline: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Outline</Button>',
  })
Outline.args = { variant: 'outline' }

export const Destructive: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Destructive</Button>',
  })
Destructive.args = { variant: 'destructive' }

export const Success: Story = (args) =>
    defineComponent({
        components: { Button },
        setup() {
            return { args }
        },
        template: '<Button v-bind="args">Success</Button>',
    })
Success.args = { variant: 'success' }

export const Ghost: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Ghost</Button>',
  })
Ghost.args = { variant: 'ghost' }

export const Link: Story = (args) =>
  defineComponent({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Link</Button>',
  })
Link.args = { variant: 'link' }

export const AllVariants: Story = () =>
  defineComponent({
    components: { Button },
    template: `
      <div class="flex flex-wrap gap-3">
        <Button variant="default">Default</Button>
        <Button variant="secondary">Secondary</Button>
        <Button variant="outline">Outline</Button>
        <Button variant="destructive">Destructive</Button>
        <Button variant="success">Success</Button>
        <Button variant="ghost">Ghost</Button>
        <Button variant="link">Link</Button>
      </div>
    `,
  })

export const Sizes: Story = () =>
  defineComponent({
    components: { Button },
    template: `
      <div class="flex flex-wrap items-center gap-3">
        <Button size="sm">Small</Button>
        <Button size="default">Default</Button>
        <Button size="lg">Large</Button>
      </div>
    `,
  })

export const Disabled: Story = () =>
  defineComponent({
    components: { Button },
    template: `
      <div class="flex flex-wrap gap-3">
        <Button disabled>Default</Button>
        <Button variant="secondary" disabled>Secondary</Button>
        <Button variant="outline" disabled>Outline</Button>
      </div>
    `,
  })
