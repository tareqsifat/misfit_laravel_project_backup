<template>
    <div id="meta-test">
        <metainfo>
            <template v-slot:title="{ content }">{{ content }} - Meta test</template>
        </metainfo>
    </div>
</template>
<script>
import { useMeta } from 'vue-meta'
export default {
    setup () {
    useMeta({
      title: 'My Example App',
      htmlAttrs: {
        lang: 'en',
        amp: true
      }
    })
  }
}
</script>
