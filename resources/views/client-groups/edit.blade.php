@extends('dashboard.layouts.main');

@section('container')
    <form id="formEdit" method="post" action="/marketing/client-groups/{{ $client_group->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="p-4 w-[350px] h-[500px] border rounded-lg bg-stone-300">
                <div class="flex items-center justify-center mb-2 border-b w-full">
                    <h4 class="text-xl font-semibold tracking-wider text-stone-900">Edit Group Klien</h4>
                </div>
                <div>
                    <div class="flex justify-center mt-4 w-full">
                        <div class="mt-1">
                            <div class="flex">
                                <label class="text-sm text-stone-900">Nama Group</label>
                            </div>
                            <div class="mt-1">
                                <input
                                    class="flex text-semibold w-[250px]  border rounded-lg p-1 outline-none @error('group') is-invalid @enderror"
                                    type="text" id="group" name="group" value="{{ $client_group->group }}"
                                    placeholder="Input Nama Group" required>
                                @error('group')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-2 w-full">
                        <div class="mt-1">
                            <label class="text-sm text-stone-900">Tambah Member</label>
                            <select class="flex text-semibold w-[250px]  border rounded-lg p-1 outline-none mb-4"
                                onchange="addMember(this)">
                                <option value="pilih">-- Pilih Klien --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="member" name="member" value="{{ $client_group->member }}" hidden>
                            <div id="cloneChild" hidden>
                                <div class="flex items-center border-b">
                                    <label class="flex w-56"></label>
                                    <button type="button" class="btn-del-note w-max h-4" onclick="removeAction(this)">
                                        <svg class="fill-current w-3" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <label class="text-sm text-stone-900">Daftar Member :</label>
                            <div id="data-member" class="text-sm text-stone-900">
                                @php
                                    $members = json_decode($client_group->member);
                                @endphp
                                @foreach ($members as $member)
                                    <div class="flex items-center border-b">
                                        <label class="flex w-56">- {{ $member->name }}</label>
                                        <button type="button" id="{{ $loop->iteration - 1 }}"
                                            class="btn-del-note w-max h-4" onclick="removeAction(this)">
                                            <svg class="fill-current w-3" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            @error('member')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center mt-2 w-full">
                        <div class="flex justify-center mt-4">
                            <button class="flex items-center justify-center btn-primary mx-1" type="button"
                                onclick="submitAction()">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M15.004 3h2.996v5h-2.996v-5zm8.996 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9zm-2 2h-14v1h14v-1zm0 2h-14v1h14v-1zm0 2h-14v1h14v-1z" />
                                </svg>
                                <span class="mx-2"> Save </span>
                            </button>
                            <a href="/marketing/client-groups" class="flex items-center justify-center btn-danger mx-1">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Cancel </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <script>
        const group = document.getElementById("group");
        const member = document.getElementById("member");
        const dataMember = document.getElementById("data-member");
        const formEdit = document.getElementById("formEdit");
        let members = JSON.parse(member.value);

        addMember = (sel) => {
            var status = true;
            if (sel.value != "pilih") {
                if (members.length == 0) {
                    var data = {
                        id: sel.value,
                        name: sel.options[sel.selectedIndex].text
                    }
                    members.push(data);
                    duplicateChildNodes("cloneChild", sel);
                } else {
                    for (let i = 0; i < members.length; i++) {
                        if (members[i].id == sel.value) {
                            alert('Client sudah terdaftar dalam member, silahkan pilih klien yang lain..!!');
                            status = false;
                        }
                    }
                    if (status == true) {
                        var data = {
                            id: sel.value,
                            name: sel.options[sel.selectedIndex].text
                        }
                        members.push(data);
                        duplicateChildNodes("cloneChild", sel);
                    }
                }
            }
            member.value = JSON.stringify(members);
        }

        submitAction = () => {
            if (group.value == "") {
                alert('Silahkan input nama group terlebih dahulu..!!');
                group.focus();
            } else {
                if (members.length < 2) {
                    alert('Member harus lebih dari 1 (satu) klien, silahkan tambahkan member');
                } else {
                    formEdit.submit();
                }
            }
        }

        removeAction = (sel) => {
            dataMember.removeChild(dataMember.children[sel.id]);
            members.splice(sel.id, 1);
            for (let i = 0; i < dataMember.children.length; i++) {
                dataMember.children[i].children[1].setAttribute('id', i);
            }
            member.value = JSON.stringify(members);
        }

        function duplicateChildNodes(eFrom, sel) {
            var eFrom = document.getElementById(eFrom);
            NodeList.prototype.forEach = Array.prototype.forEach;
            var children = eFrom.childNodes;
            children.forEach(function(item) {
                var cln = item.cloneNode(true);
                dataMember.appendChild(cln);

            });
            dataMember.children[dataMember.children.length - 1].children[0].innerHTML = '- ' + sel
                .options[sel
                    .selectedIndex].text;
            for (let i = 0; i < dataMember.children.length; i++) {
                dataMember.children[i].children[1].setAttribute('id', i);
            }
        };
    </script>
@endsection
