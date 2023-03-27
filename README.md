# Create a completer function

In `.bashrc`, replace `sl` with the name of your `binary`;

```bash
_slam_dunk()
{
    _get_comp_words_by_ref -n : cur

    opts=$(sl complete $cur)

    COMPREPLY=( $(compgen -W "${opts}" -- ${cur}) )

    __ltrim_colon_completions "$cur"
}

complete -F _slam_dunk sl
```