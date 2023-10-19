<template>
  <div class="TabbedViewItem">
    <va-card>
      <div class="TabbedViewItem__Body">
        <slot name="body"></slot>
      </div>
      <div class="TabbedViewItem__Footer">
        <slot name="footer"></slot>
      </div>
    </va-card>
  </div>
</template>

<style lang="scss">
  .TabbedViewItem {
    margin-bottom: 1.5em;
    &__Body {
      padding-top: 1.25em;
      padding-bottom: 1.25em;
      display: flex;
      justify-content: space-between;
    }

    &__Footer {
      padding-top: 0.75em;
      padding-bottom: 0.75em;
      background-color: var(--va-background-primary);
      display: flex;
      justify-content: space-between;
    }

    &__Body,
    &__Footer {
      padding-left: 1.5em;
      padding-right: 1.5em;
    }
  }
</style>
