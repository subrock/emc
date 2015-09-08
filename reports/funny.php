<html>
  <head>
    <style>
      .example_desc {
        font-family: Arial;
        font-size: 18px;
      }
      
      .wide_spacing {
        font-family: Arial;
        font-size: 36px;
        letter-spacing: 2px;
        word-spacing: 8px;
      }
    </style>
  </head>

  <body>
    <svg width="900" height="600">
      <desc>Example 1: Text on a path</desc>
      <text class="example_desc" x="50" y="20">Example 1: Text on a path</text>
      <defs>
        <path id="text-path" d="M 50 70 l 170 0 l 0 130 l 200 0">
      </defs>
      <use xlink:href="#text-path" fill="none" stroke="blue" />
      <text class="wide_spacing">
        <textPath xlink:href="#text-path">This text follows a line</textPath>
      </text>

      <desc>Example 2: Text with decoration</desc>
      <text class="example_desc" x="500" y="20">Example 2: Text with decoration</text>
      <g font-size="25" fill="blue" stroke="gray" stroke-width="1" >
        <text x="500" y="80" text-decoration="line-through" >Text with line-through</text>
        <text x="500" y="140" text-decoration="underline" >Underlined text</text>
        <text x="500" y="200" text-decoration="underline" >
          <tspan>Each </tspan>
          <tspan fill="white" stroke="purple" >word </tspan>
          <tspan fill="white" stroke="black" >has </tspan>
          <tspan fill="white" stroke="darkgreen" text-decoration="underline" >different </tspan>
          <tspan fill="white" stroke="blue" >underlining</tspan>
        </text>
      </g>

      <desc>Example 3: Lively text on a path</desc>
      <text class="example_desc" x="50" y="300">Example 3: Lively text on a path</text>
      <defs>
        <path id="MyPath" d="M 100 420
                             C 110 400 210 300 310 400
                             C 400 500 420 520 460 500
                             C 620 400 670 400 690 400" />
      </defs>
      <use xlink:href="#MyPath" fill="none" stroke="red"  />
      <text font-family="Verdana" font-size="30" fill="blue" >
        <textPath xlink:href="#MyPath">
          We go 
          <tspan dy="-25" fill="red" > up </tspan>
          <tspan dy="25"> , </tspan>
          then we go
          <tspan dy="25" fill="green"> down </tspan>
          <tspan dy="-25"> , </tspan>
          then up again
        </textPath>
      </text>

    </svg>
  </body>
</html>

