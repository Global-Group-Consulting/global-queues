<template>
  <div class="btn-group">
    <button type="button" class="btn" :class="'btn-' + color">
      <slot name="main-content"></slot>
    </button>

    <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
            :class="'btn-' + colorSplit"
            data-bs-toggle="dropdown"
            aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
      <slot></slot>
    </ul>
  </div>
</template>

<script>
export default ({
  name: 'Dropdown',
  props: {
    color: String,
    colorSplit: String
  }
})
</script>

<style scoped>

</style>
