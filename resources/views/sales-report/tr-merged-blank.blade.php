<tr>
    <td class="text-black border text-[0.65rem] text-center bg-lime-50" colspan="8">
        @if (count($videotronSales) != 0)
            Slot ke {{ $usedSlot }}
        @else
            Slot ke {{ $indexSlot + 1 }}
        @endif
    </td>
</tr>
