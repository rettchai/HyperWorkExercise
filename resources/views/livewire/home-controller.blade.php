<div>
    Home pages


    @auth
        <div>

            <pre>
                <code>
                    currentAccessToken : {{ var_dump(auth('sanctum')->user()) }}
                </code>
        </pre>
        </div>
        <pre>
        <code>
            {{ print_r(auth()->user()) }}
        </code>
    </pre>
    @endauth



</div>
