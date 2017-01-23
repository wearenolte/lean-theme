# CSS3 Animations

You can reuse any of the animations that are available in [animate.css](https://daneden.github.io/animate.css/) just by addig the import into the `_animate.scss` file.

```scss
import "../../node_modules/animatewithsass/_properties";
```

You an also be more specific and import unique animations instead of sets.

```scss
@import "../../node_modules/animatewithsass/_attention-seekers/attention-seekers.scss";
@import "../../node_modules/animatewithsass/_bouncing-entrances/bouncing-entrances.scss";
@import "../../node_modules/animatewithsass/_bouncing-exits/bouncing-exits.scss";
@import "../../node_modules/animatewithsass/_fading-entrances/fading-entrances.scss";
@import "../../node_modules/animatewithsass/_fading-exits/fading-exits.scss";
@import "../../node_modules/animatewithsass/_flippers/flippers.scss";
@import "../../node_modules/animatewithsass/_lightspeed/lightspeed.scss";
@import "../../node_modules/animatewithsass/_rotating-entrances/rotating-entrances.scss";
@import "../../node_modules/animatewithsass/_rotating-exits/rotating-exits.scss";
@import "../../node_modules/animatewithsass/_specials/specials.scss";
```

Usage examples: 

```scss
.myClass {
  @include bounceIn($count, $duration, $delay, $function, $fill, $visibility);
}
```
